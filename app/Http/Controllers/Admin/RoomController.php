<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of rooms
     */
    public function index(): View
    {
        $rooms = Room::withCount('bookings')->orderBy('name')->paginate(10);
        
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new room
     */
    public function create(): View
    {
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created room
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'location' => 'nullable|string|max:255',
            'available_from' => 'required|date_format:H:i',
            'available_until' => 'required|date_format:H:i|after:available_from',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string|max:100',
            'status' => 'required|in:available,maintenance,unavailable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('rooms', 'public');
        }

        Room::create([
            'name' => $request->name,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'location' => $request->location,
            'available_from' => $request->available_from,
            'available_until' => $request->available_until,
            'facilities' => $request->facilities ?? [],
            'status' => $request->status,
            'image' => $imagePath
        ]);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil ditambahkan.');
    }

    /**
     * Display the specified room
     */
    public function show(Room $room): View
    {
        $room->load(['bookings' => function($query) {
            $query->where('booking_date', '>=', today())
                  ->orderBy('booking_date')
                  ->orderBy('time_from');
        }]);
        
        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified room
     */
    public function edit(Room $room): View
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified room
     */
    public function update(Request $request, Room $room): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'location' => 'nullable|string|max:255',
            'available_from' => 'required|date_format:H:i',
            'available_until' => 'required|date_format:H:i|after:available_from',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string|max:100',
            'status' => 'required|in:available,maintenance,unavailable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $updateData = [
            'name' => $request->name,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'location' => $request->location,
            'available_from' => $request->available_from,
            'available_until' => $request->available_until,
            'facilities' => $request->facilities ?? [],
            'status' => $request->status
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $updateData['image'] = $request->file('image')->store('rooms', 'public');
        }

        $room->update($updateData);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil diperbarui.');
    }

    /**
     * Remove the specified room
     */
    public function destroy(Room $room): RedirectResponse
    {
        // Check if room has bookings
        if ($room->bookings()->count() > 0) {
            return back()->withErrors(['delete' => 'Tidak dapat menghapus ruangan yang memiliki booking.']);
        }

        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil dihapus.');
    }
}
