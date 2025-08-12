<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return Notification::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'content'        => ['required','string'],
            'dateOfCreation' => ['nullable','date'],
            'timeOfSend'     => ['nullable','date_format:H:i'],
            'isRead'         => ['nullable','boolean'],
        ]);

        $n = Notification::create($data);
        return response()->json($n, 201);
    }

    public function show(Notification $notification)
    {
        return $notification;
    }

    public function update(Request $request, Notification $notification)
    {
        $data = $request->validate([
            'content'        => ['sometimes','string'],
            'dateOfCreation' => ['sometimes','nullable','date'],
            'timeOfSend'     => ['sometimes','nullable','date_format:H:i'],
            'isRead'         => ['sometimes','boolean'],
        ]);

        $notification->update($data);
        return $notification;
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return response()->noContent();
    }
}
