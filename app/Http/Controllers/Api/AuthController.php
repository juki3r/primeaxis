<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PongMtaUser;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    // Register new user
    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'mobile_number' => 'required|string|unique:pong_mta_users',
            'password' => 'required|string|min:6|confirmed', // password_confirmation field
        ]);

        $user = PongMtaUser::create([
            'fullname' => $request->fullname,
            'address' => $request->address,
            'mobile_number' => $request->mobile_number,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'data' => $user,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = PongMtaUser::where('mobile_number', $request->mobile_number)->first();

        // ❌ Invalid credentials
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid mobile number or password',
            ], 401);
        }

        // 🔐 MOBILE NOT VERIFIED → SEND OTP
        if (!$user->mobile_verified) {

            // ⛔ Prevent OTP spam (wait 60s before resend)
            if ($user->otp_expires_at && now()->diffInSeconds($user->otp_expires_at) > 240) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please wait before requesting another OTP',
                ], 429);
            }

            // 🔢 Generate OTP
            $otp = random_int(100000, 999999);

            // 🔐 Store HASHED OTP
            $user->otp = Hash::make($otp);
            $user->otp_expires_at = now()->addMinutes(2);
            $user->save();

            // 📩 Send SMS via your SMS Gateway
            try {
                Http::withHeaders([
                    'X-API-KEY' => config('services.sms.api_key'),
                ])->post('https://sms.pong-mta.tech/api/send-sms-api', [
                    'phone_number' => $user->mobile_number,
                    'message' => "PONG OTP: {$otp}\nValid for 2 minutes.\nDo not share this code.",
                ]);
            } catch (\Exception $e) {
                // optional logging
            }

            return response()->json([
                'success' => false,
                'message' => 'Mobile number not verified. OTP sent.',
                'data' => [
                    'mobile_number' => $user->mobile_number,
                    'otp_sent' => true,
                    'expires_in' => 120, // seconds (matches app timer)
                ],
            ], 403);
        }
        // ✅ CREATE TOKEN
        $token = $user->createToken('pong-app-token')->plainTextToken;

        $businessExists = false;

        if ($user->role === 'business') {
            $businessExists = $user->business ? true : false;
        }

        // ✅ LOGIN SUCCESS
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'mobile_number' => $user->mobile_number,
                'role' => $user->role,
                'business_exists' => $businessExists,
                'token' => $token,
            ],
        ]);
    }

    //Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required|string',
            'otp' => 'required|string',
        ]);

        $user = PongMtaUser::where('mobile_number', $request->mobile_number)->first();

        if (!$user || !$user->otp || !$user->otp_expires_at) {
            return response()->json(['message' => 'Invalid request'], 400);
        }

        if (now()->gt($user->otp_expires_at)) {
            return response()->json(['message' => 'OTP expired'], 410);
        }

        if (!Hash::check($request->otp, $user->otp)) {
            return response()->json(['message' => 'Invalid OTP'], 401);
        }

        // ✅ Verified
        $user->mobile_verified = true;
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Mobile verified successfully',
        ]);
    }

    //Resend OTP
    public function resendOtp(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required|string',
        ]);

        $user = PongMtaUser::where('mobile_number', $request->mobile_number)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        if ($user->mobile_verified) {
            return response()->json([
                'success' => false,
                'message' => 'Mobile number already verified',
            ], 409);
        }

        // ⏱ Prevent spam (2-minute cooldown)
        if ($user->otp_expires_at && now()->lt($user->otp_expires_at->subMinutes(3))) {
            return response()->json([
                'success' => false,
                'message' => 'Please wait before requesting another OTP',
            ], 429);
        }

        // 🔐 Generate new OTP
        $otp = rand(100000, 999999);

        $user->otp = Hash::make($otp);
        $user->otp_expires_at = Carbon::now()->addMinutes(2);
        $user->save();

        // 📲 SEND SMS (your gateway)
        Http::withHeaders([
            'X-API-KEY' => config('services.sms.api_key'),
        ])->post('https://sms.pong-mta.tech/api/send-sms-api', [
            'phone_number' => $user->mobile_number,
            'message' => "PONG OTP: {$otp}\nValid for 2 minutes.\nDo not share this code.",
        ]);

        return response()->json([
            'success' => true,
            'message' => 'OTP resent successfully',
        ]);
    }

    //Forgot Password
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required|string',
        ]);

        $user = PongMtaUser::where('mobile_number', $request->mobile_number)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Mobile number not registered'
            ], 404);
        }

        $otp = rand(100000, 999999);

        $user->otp = Hash::make($otp);
        $user->otp_expires_at = now()->addMinutes(2);
        $user->save();

        Http::withHeaders([
            'X-API-KEY' => config('services.sms.api_key'),
        ])->post('https://sms.pong-mta.tech/api/send-sms-api', [
            'phone_number' => $user->mobile_number,
            'message' => "Your password reset OTP is {$otp}. Valid for 2 minutes.",
        ]);

        return response()->json([
            'success' => true,
            'message' => 'OTP sent',
        ]);
    }

    //Verify Forgot OTP
    public function verifyForgotOtp(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required|string',
            'otp' => 'required|string',
        ]);

        $user = PongMtaUser::where('mobile_number', $request->mobile_number)->first();
        if (!$user || !$user->otp || !$user->otp_expires_at) {
            return response()->json(['message' => 'Invalid request'], 400);
        }

        if (now()->gt($user->otp_expires_at)) {
            return response()->json(['message' => 'OTP expired'], 410);
        }

        if (!Hash::check($request->otp, $user->otp)) {
            return response()->json(['message' => 'Invalid OTP'], 401);
        }

        // OTP verified
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return response()->json(['success' => true, 'message' => 'OTP verified']);
    }

    //Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required|string',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = PongMtaUser::where('mobile_number', $request->mobile_number)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password reset successfully',
        ]);
    }
}
