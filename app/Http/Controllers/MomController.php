<?php

namespace App\Http\Controllers;

use App\Models\Mom;
use Illuminate\Http\Request;

class MomController extends Controller
{
    public function index()
    {
        return Mom::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'attachment'   => ['nullable','string','max:255'],
            'expectations' => ['nullable','string'],
            'discussions'  => ['nullable','string'],
            'actionItems'  => ['nullable','string'],
        ]);

        $mom = Mom::create($data);
        return response()->json($mom, 201);
    }

    public function show(Mom $mom)
    {
        return $mom;
    }

    public function update(Request $request, Mom $mom)
    {
        $data = $request->validate([
            'attachment'   => ['sometimes','nullable','string','max:255'],
            'expectations' => ['sometimes','nullable','string'],
            'discussions'  => ['sometimes','nullable','string'],
            'actionItems'  => ['sometimes','nullable','string'],
        ]);

        $mom->update($data);
        return $mom;
    }

    public function destroy(Mom $mom)
    {
        $mom->delete();
        return response()->noContent();
    }
}
