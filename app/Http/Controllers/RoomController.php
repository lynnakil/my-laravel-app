<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        return Room::with('features')->paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:255'],
            'capacity' => ['nullable','integer','min:0'],
            'location' => ['nullable','string','max:255'],
            'status'   => ['nullable','string','max:50'],
        ]);

        $room = Room::create($data);
        return response()->json($room, 201);
    }

    public function show(Room $room)
    {
        return $room->load('features');
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'name'     => ['sometimes','string','max:255'],
            'capacity' => ['sometimes','nullable','integer','min:0'],
            'location' => ['sometimes','nullable','string','max:255'],
            'status'   => ['sometimes','nullable','string','max:50'],
        ]);

        $room->update($data);
        return $room->fresh()->load('features');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->noContent();
    }
}
