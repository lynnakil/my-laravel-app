<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        return Note::with('meeting')->paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'content'      => ['required','string'],
            'creationDate' => ['nullable','date'],
            'meeting_id'   => ['required','exists:meetings,id'],
        ]);

        $note = Note::create($data);
        return response()->json($note, 201);
    }

    public function show(Note $note)
    {
        return $note->load('meeting');
    }

    public function update(Request $request, Note $note)
    {
        $data = $request->validate([
            'meeting_id'   => ['sometimes','exists:meetings,id'],
            'content'      => ['sometimes','string'],
            'creationDate' => ['sometimes','nullable','date'],
        ]);

        $note->update($data);
        return $note->fresh()->load('meeting');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return response()->noContent();
    }
}
