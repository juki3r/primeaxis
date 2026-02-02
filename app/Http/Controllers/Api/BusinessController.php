<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    // Get the authenticated user's business
    public function show(Request $request)
    {
        $user = $request->user();
        $business = Business::where('user_id', $user->id)->first();

        return response()->json($business);
    }

    // Create or update business
    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ]);

        $business = Business::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $request->name,
                'category' => $request->category,
                'phone' => $request->phone,
                'address' => $request->address,
            ]
        );

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($business->logo) Storage::disk('public')->delete($business->logo);

            $path = $request->file('logo')->store('business_logos', 'public');
            $business->logo = $path;
            $business->save();
        }

        return response()->json([
            'message' => 'Business profile saved successfully',
            'business' => $business
        ]);
    }
}
