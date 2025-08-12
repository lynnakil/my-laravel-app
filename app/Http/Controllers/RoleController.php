<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return Role::with('user')->paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type'    => ['required','string','max:100'],
            'user_id' => ['required','exists:users,id'],
        ]);

        $role = Role::create($data);
        return response()->json($role, 201);
    }

    public function show(Role $role)
    {
        return $role->load('user');
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'user_id' => ['sometimes','exists:users,id'],
            'type'    => ['sometimes','string','max:100'],
        ]);

        $role->update($data);
        return $role->fresh()->load('user');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->noContent();
    }
}
