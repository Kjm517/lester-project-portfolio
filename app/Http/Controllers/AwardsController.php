<?php

namespace App\Http\Controllers;

use App\Models\Awards;
use Illuminate\Http\Request;

class AwardsController extends Controller
{
    public function index()
    {
        $awards = Awards::all();
        return response()->json(['awards' => $awards], 200); 
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'award_name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'expiration' => 'nullable|date',
            'photo' => 'nullable|string|max:255',
            'cert_link' => 'nullable|string|max:255',
        ]);

        // Handle the photo upload if provided
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/awards-images', $imageName);
            $validatedData['photo'] = 'awards-images/' . $imageName;
        }

        $awards = Awards::create($validated);

        return response()->json(['message' => 'awards added', 'awards' => $awards], 201);
    }

    public function update(Request $request, $id)
    {
        \Log::info('Update request received:', $request->all());

        $award = Awards::find($id);

        if (!$award) {
            return response()->json(['message' => 'Award not found'], 404);
        }

        $validatedData = $request->validate([
            'award_name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'expiration' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cert_link' => 'nullable|url',
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/awards-images', $imageName);
            $validatedData['photo'] = 'awards-images/' . $imageName;
        }

        $award->update($validatedData);

        return response()->json(['message' => 'Award updated successfully', 'award' => $award]);
    }


    public function destroy($id)
    {
        $award = Awards::find($id);

        if (!$award) {
            return response()->json(['message' => 'Award not found'], 404);
        }

         if ($award->photo) {
            Storage::delete('public/' .  substr($award->photo, strlen('/'))); //Remove the file
        }

        $award->delete();

        return response()->json(['message' => 'Award deleted successfully'], 200);
    }


}
