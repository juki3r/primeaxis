<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
Route::post('/appointments', [AppointmentController::class, 'store']);


Route::get('/mail-test', function () {
    Mail::raw('Test email from PONG-MTA', function ($msg) {
        $msg->to('ajcpisonet@gmail.com')
            ->subject('SMTP Test');
    });
    return 'Mail sent!';
});
