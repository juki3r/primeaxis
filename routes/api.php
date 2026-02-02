<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\BusinessController;
use Illuminate\Support\Facades\Route;



Route::get('/ping', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'pong',
    ]);
});

//Register and Login PONG Mobile App
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Verify OTP
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
//Resend OTP
Route::post('/resend-otp', [AuthController::class, 'resendOtp']);
//Forgot Password
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
//verify Forgot OTP
Route::post('/verify-forgot-otp', [AuthController::class, 'verifyForgotOtp']);
//Reset Password
Route::post('/reset-password', [AuthController::class, 'resetPassword']);


//Add or save business details of business owner
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/business', [BusinessController::class, 'show']);
    Route::post('/business', [BusinessController::class, 'store']);
});
