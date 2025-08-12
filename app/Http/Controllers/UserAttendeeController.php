<?php

namespace App\Http\Controllers;

use App\Models\UserAttendee;
use Illuminate\Http\Request;

class UserAttendeeController extends Controller
{
    public function index()
    {
        return UserAttendee::with(['user','room'])->paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'role'    => ['nullable','string','max:50'],
            'user_id' => ['required','exists:users,id'],
            'room_id' => ['required','exists:rooms,id'],
        ]);

        $ua = UserAttendee::create($data);
        return response()->json($ua, 201);
    }

    public function show(UserAttendee $userAttendee)
    {
        return $userAttendee->load(['user','room']);
    }

    public function update(Request $request, UserAttendee $userAttendee)
    {
        $data = $request->validate([
            'user_id' => ['sometimes','exists:users,id'],
            'room_id' => ['sometimes','exists:rooms,id'],
            'role'    => ['sometimes','nullable','string','max:50'],
        ]);

        $userAttendee->update($data);
        return $userAttendee->fresh()->load(['user','room']);
    }

    public function destroy(UserAttendee $userAttendee)
    {
        $userAttendee->delete();
        return response()->noContent();
    }
}
