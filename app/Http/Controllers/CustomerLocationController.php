<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerLocationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);

        $user = auth()->user();

        $user->latitude = $validated['latitude'];
        $user->longitude = $validated['longitude'];
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Location saved successfully.',
        ]);
    }
}