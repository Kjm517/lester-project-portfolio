<?php

namespace App\Http\Controllers;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::orderBy('id', 'desc')->get();

        return response()->json([
            'abouts' => $abouts
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'description' => 'nullable|string|max:255',
                'skills' => 'nullable|string|max:255'
            ]);

            $about = About::create($validated);

            return response()->json([
                'message' => 'Data saved successfully',
                'data' => $about
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $about = About::findOrFail($id);
        $about->description = $request->description;
    
        $skillsArray = $request->has('skills') 
            ? (is_array($request->skills) ? $request->skills : explode(',', $request->skills))
            : [];
    
        $about->skills = implode(',', $skillsArray);
    
        $about->save();
    
        return response()->json(['message' => 'Updated successfully', 'about' => $about]);
    }
       
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
