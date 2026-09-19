<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'village' => 'nullable|string|max:100',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'type' => 'required|in:home,work',

            // Location
            'latitude' => [
                'required',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'required',
                'numeric',
                'between:-180,180',
            ],
        ]);

        // Save customer address
        $address = Address::create([
            'user_id' => auth()->id(),

            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'landmark' => $request->landmark,
            'village' => $request->village,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,

            // Location
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,

            'type' => $request->type,
            'is_default' => false,
        ]);

        // Sync latest saved address location to users table
        
        auth()->user()->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()
            ->route('checkout.index')
            ->with('success', 'Address added successfully.');
    }
}
