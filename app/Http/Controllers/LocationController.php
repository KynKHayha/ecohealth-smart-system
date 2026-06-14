<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('admin.tracking', compact('locations'));
    }

    public function trackingUser()
    {
        $locations = Location::all();
        return view('tracking_user', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:greenhouse,waste,other',
            'lat'  => 'required|numeric',
            'lng'  => 'required|numeric',
        ]);

        Location::create([
            'name' => $request->name,
            'type' => $request->type,
            'lat'  => $request->lat,
            'lng'  => $request->lng,
        ]);

        return redirect()->route('location.index')->with('success', 'Lokasi berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Location::findOrFail($id)->delete();
        return redirect()->route('location.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}
