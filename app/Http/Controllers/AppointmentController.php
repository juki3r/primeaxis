<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'full_name' => 'required|string|max:255',
            'address'   => 'required|string',
            'contact'   => 'required|string|max:255',
        ]);

        // ✅ Detect contact type
        $isEmail = filter_var($request->contact, FILTER_VALIDATE_EMAIL);
        $contactType = $isEmail ? 'email' : 'phone';

        // ✅ Save to database
        $appointment = Appointment::create([
            'full_name'    => $request->full_name,
            'address'      => $request->address,
            'contact'      => $request->contact,
            'contact_type' => $contactType,
        ]);

        /*
    |--------------------------------------------------------------------------
    | 📧 EMAIL NOTIFICATIONS
    |--------------------------------------------------------------------------
    */
        if ($isEmail) {
            try {
                // Email to CLIENT
                Mail::raw(
                    "Hello {$appointment->full_name},\n\n" .
                        "Thank you for booking an appointment with PONG-MTA Technology Solutions.\n\n" .
                        "📌 Appointment Details:\n" .
                        "Name: {$appointment->full_name}\n" .
                        "Address: {$appointment->address}\n" .
                        "Contact: {$appointment->contact}\n\n" .
                        "Our team will contact you shortly.\n\n" .
                        "— PONG-MTA Technology Solutions",
                    function ($message) use ($appointment) {
                        $message->to($appointment->contact)
                            ->subject('Appointment Confirmation - PONG-MTA');
                    }
                );

                // Email to ADMIN
                Mail::raw(
                    "🚨 New Appointment Received\n\n" .
                        "Name: {$appointment->full_name}\n" .
                        "Address: {$appointment->address}\n" .
                        "Contact: {$appointment->contact}\n",
                    function ($message) {
                        $message->to('pongmta26@gmail.com')
                            ->subject('New Appointment - PONG-MTA');
                    }
                );
            } catch (\Exception $e) {
                Log::error('Email sending failed: ' . $e->getMessage());
            }
        }

        /*
    |--------------------------------------------------------------------------
    | 📲 SMS NOTIFICATION
    |--------------------------------------------------------------------------
    */
        if ($contactType === 'phone') {
            try {

                Http::withHeaders([
                    'X-API-KEY' => config('services.sms.api_key'),
                ])->post('https://sms.pong-mta.tech/api/send-sms-api', [
                    'phone_number' => $appointment->contact,
                    'message' =>
                    "PONG-MTA Appointment\n" .
                        "Hi {$appointment->full_name},\n" .
                        "Your appointment request has been received.\n" .
                        "We will contact you shortly.\n\n" .
                        "- PONG-MTA",
                ]);

                // 📲 SMS to admin
                Http::withHeaders([
                    'X-API-KEY' => config('services.sms.api_key'),
                ])->post('https://sms.pong-mta.tech/api/send-sms-api', [
                    'phone_number' => '09562078139', // admin number
                    'message' =>
                    "New Appointment Booked\n" .
                        "Name: {$appointment->full_name}\n" .
                        "Contact: {$appointment->contact}\n" .
                        "Address: {$appointment->address}",
                ]);
            } catch (\Exception $e) {
                Log::error('Appointment SMS failed: ' . $e->getMessage());
            }
        }

        // ✅ JSON response for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Appointment booked successfully. We will contact you soon.'
        ]);
    }
}
