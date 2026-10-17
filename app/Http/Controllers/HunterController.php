<?php

namespace App\Http\Controllers;

use App\Models\Hunter;
use Illuminate\Http\Request;

class HunterController extends Controller
{
    public function index(Request $request)
    {
        $query = Hunter::query();

        $allowedFilters = [
            'name',
            'rank',
            'class',
            'level',
            'power',
        ];

        foreach ($allowedFilters as $field) {
            if ($request->has($field)) {
                $query->where($field, $request->input($field));
            }
        }

        return response()->json($query->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rank' => 'required|string|max:10',
            'class' => 'required|string|max:100',
            'level' => 'required|integer|min:1',
            'power' => 'required|integer|min:0',
        ]);

        $hunter = Hunter::create($validated);

        return response()->json($hunter, 201);
    }

    public function show(Hunter $hunter)
    {
        return response()->json($hunter, 200);
    }

    public function update(Request $request, Hunter $hunter)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rank' => 'required|string|max:10',
            'class' => 'required|string|max:100',
            'level' => 'required|integer|min:1',
            'power' => 'required|integer|min:0',
        ]);

        $hunter->update($validated);

        return response()->json($hunter, 200);
    }

    public function destroy(Hunter $hunter)
    {
        $hunter->delete();

        return response()->noContent();
    }
}
