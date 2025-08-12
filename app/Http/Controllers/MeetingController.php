<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index()
{
    return \App\Models\Meeting::with(['room','mom'])
        ->orderBy('date', 'desc')
        ->paginate(20);
}

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'     => ['required','string','max:255'],
            'agenda'    => ['nullable','string'],
            'date'      => ['required','date'],
            'startTime' => ['required','date_format:H:i'],
            'endTime'   => ['required','date_format:H:i','after:startTime'],
            'room_id'   => ['required','exists:rooms,id'],
            'mom_id'    => ['nullable','exists:moms,id'],
        ]);

        $m = Meeting::create($data);
        return response()->json($m, 201);
    }

    public function show(Meeting $meeting)
    {
        return $meeting->load(['room','mom','notes','invitations']);
    }

    public function update(Request $request, Meeting $meeting)
    {
        $data = $request->validate([
            'room_id'   => ['sometimes','exists:rooms,id'],
            'mom_id'    => ['sometimes','nullable','exists:moms,id'],
            'title'     => ['sometimes','string','max:255'],
            'agenda'    => ['sometimes','nullable','string'],
            'date'      => ['sometimes','date'],
            'startTime' => ['sometimes','date_format:H:i'],
            'endTime'   => ['sometimes','date_format:H:i','after:startTime'],
        ]);

        $meeting->update($data);
        return $meeting->fresh()->load(['room','mom']);
    }

    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return response()->noContent();
    }
}

