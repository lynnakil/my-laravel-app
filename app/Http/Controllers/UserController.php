<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'firstName' => 'required|string',
        'lastName' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'phoneNb' => 'required|string',
        'password' => 'required|string',
        'role_ID' => 'required|integer',
        'notification_ID' => 'nullable|integer',
    ]);

    $validated['password'] = bcrypt($validated['password']); // hash password

    $user = User::create($validated);

    return response()->json($user, 201);
}


    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'firstName' => 'sometimes|string',
            'lastName' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phoneNb' => 'sometimes|string',
            'password' => 'sometimes|string|min:6',
            'role_ID' => 'nullable|integer',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return $user;
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }
}
