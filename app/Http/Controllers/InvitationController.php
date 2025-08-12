<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function index()
    {
        return Invitation::with(['user','meeting'])->paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'attendees'  => ['required','string'], 
            'user_id'    => ['required','exists:users,id'],
            'meeting_id' => ['required','exists:meetings,id'],
        ]);

        $inv = Invitation::create($data);
        return response()->json($inv, 201);
    }

    public function show(Invitation $invitation)
    {
        return $invitation->load(['user','meeting']);
    }

    public function update(Request $request, Invitation $invitation)
    {
        $data = $request->validate([
            'user_id'    => ['sometimes','exists:users,id'],
            'meeting_id' => ['sometimes','exists:meetings,id'],
            'attendees'  => ['sometimes','string'], // or ['sometimes','integer','min:1']
        ]);

        $invitation->update($data);
        return $invitation->fresh()->load(['user','meeting']);
    }

    public function destroy(Invitation $invitation)
    {
        $invitation->delete();
        return response()->noContent();
    }
}
