<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::all();
        return response()->json(['experiences' => $experiences], 200);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'position' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'year' => 'required|date',
        ]);

        $experience = Experience::create($validated);

        return response()->json(['message' => 'Experience added', 'experience' => $experience], 201);
    }

    public function update(Request $request, $id)
    {
        $experience = Experience::find($id);

        if (!$experience) {
            return response()->json(['message' => 'Experience not found'], 404);
        }

        $validated = $request->validate([
            'position' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'year' => 'required|date',
        ]);

        $experience->update($validated);

        return response()->json(['message' => 'Experience updated', 'experience' => $experience], 200);
    }

    public function destroy($id)
    {
        $experience = Experience::find($id);

        if (!$experience) {
            return response()->json(['message' => 'Experience not found'], 404);
        }

        $experience->delete();

        return response()->json(['message' => 'Experience deleted'], 200);
    }
}
