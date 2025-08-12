<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $r)
    {
        $data = $r->validate([
            'firstName' => ['required','string','max:100'],
            'lastName'  => ['required','string','max:100'],
            'email'     => ['required','email','max:255','unique:users,email'],
            'phoneNb'   => ['nullable','string','max:50'],
            'password'  => ['required','string','min:8','confirmed'],
            'role'      => ['nullable','in:admin,user'],
        ]);

        $roleId = Role::where('type', $data['role'] ?? 'user')->value('id');

        $user = User::create([
            'firstName' => $data['firstName'],
            'lastName'  => $data['lastName'],
            'email'     => $data['email'],
            'phoneNb'   => $data['phoneNb'] ?? null,
            'password'  => Hash::make($data['password']),
            'role_ID'   => $roleId,
        ]);

        $token = auth('api')->login($user);

        return response()->json([
            'message'      => 'Registered',
            'user'         => $user,
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
        ], 201);
    }

    public function login(Request $r)
    {
        $credentials = $r->validate([
            'email'    => ['required','email'],
            'password' => ['required','string'],
        ]);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
        ]);
    }

    public function me()     { return response()->json(auth('api')->user()); }
    public function logout() { auth('api')->logout(); return response()->json(['message' => 'Logged out']); }
    public function refresh(){ return response()->json([
        'access_token' => auth('api')->refresh(),
        'token_type'   => 'bearer',
        'expires_in'   => auth('api')->factory()->getTTL() * 60,
    ]); }
}
