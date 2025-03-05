<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolio = Portfolio::all();
        return response()->json(['portfolio' => $portfolio], 200);
    }


    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'project_description' => 'required|string|max:255',
            'programming_language' => 'nullable|string|max:255',
            'link' => 'nullable|url',           
+           'project_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('project_image')) {
            $image = $request->file('project_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/portfolio', $filename); // Store in storage/app/public/portfolio
+           $data['project_image'] = '/storage/portfolio/' . $filename; // Store the path in the database
        } else {
            $data['project_image'] = null;
        }
        $portfolio = Portfolio::create($data);

        return response()->json(['message' => 'Portfolio added', 'portfolio' => $portfolio], 201);
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::find($id);

        if (!$portfolio) {
            return response()->json(['message' => 'Portfolio not found'], 404);
        }

        $request->validate([
            'project_name' => 'sometimes|string|max:255',
            'project_description' => 'sometimes|string',
            'programming_language' => 'nullable|string',
            'link' => 'nullable|url',
            'project_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('project_image')) {
            $image = $request->file('project_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            // Store file and log the actual path
            $path = $image->storeAs('public/portfolio', $filename);
            Log::debug("Image stored at: " . storage_path("app/$path"));
        
            $data['project_image'] = "/storage/portfolio/" . $filename;
        } else {
            unset($data['project_image']); // Remove project_image if it is not included in the request
        }
    }



    public function destroy($id)
    {
        $portfolio = Portfolio::find($id);

        if (!$portfolio) {
            return response()->json(['message' => 'Portfolio not found'], 404);
        }

        if ($portfolio->project_image) {
            Storage::delete('public/' .  substr($portfolio->project_image, strlen('/storage/')));
        }

        $portfolio->delete();

        return response()->json(['message' => 'Portfolio deleted'], 200);
    }
}
