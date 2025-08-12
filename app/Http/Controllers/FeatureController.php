<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        return Feature::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:features,name'],
        ]);

        $feature = Feature::create($data);
        return response()->json($feature, 201);
    }

    public function show(Feature $feature)
    {
        return $feature;
    }

    public function update(Request $request, Feature $feature)
    {
        $data = $request->validate([
            'name' => ['sometimes','string','max:255','unique:features,name,'.$feature->id],
        ]);

        $feature->update($data);
        return $feature;
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
        return response()->noContent();
    }
}
