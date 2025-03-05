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
            'start_year' => 'required|integer|min:1900|max:2100',
            'start_month' => 'required|integer|min:1|max:12',
            'end_year' => 'required|integer|min:1900|max:2100',
            'end_month' => 'required|integer|min:1|max:12',
        ]);

        $experience = Experience::create($validated);

        return response()->json(['message' => 'Experience added', 'experience' => $experience], 201);
    }

    public function update(Request $request, $id)
    {
        $experience = Experience::find($id); // ✅ Correct: Use Experience model

        if (!$experience) {
            return response()->json(['message' => 'Experience not found'], 404);
        }

        $request->validate([
            'position' => 'sometimes|string|max:255',
            'company' => 'sometimes|string|max:255',
            'start_year' => 'sometimes|integer|min:1900|max:2100',
            'start_month' => 'sometimes|integer|min:1|max:12',
            'end_year' => 'sometimes|integer|min:1900|max:2100',
            'end_month' => 'sometimes|integer|min:1|max:12',
        ]);

        $experience->update($request->all());

        return response()->json(['message' => 'Experience updated successfully', 'experience' => $experience]);
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
