<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accessories;

class AccessoriesController extends Controller
{
    public function index()
    {
        $accessories = Accessories::all();
        $categories = Accessories::distinct('type')->pluck('type');

        return view('accessories', compact('accessories', 'categories'));
    }

    public function showByCategory(Request $request)
    {
        // Get the selected category from the request
        $selectedCategory = $request->input('category');

        // Retrieve accessories based on the specified category
        $accessories = Accessories::where('type', $selectedCategory)->get();

        return view('accessories.category', compact('accessories', 'selectedCategory'));
    }

    public function showDetails($id)
    {
        $accessory = Accessories::findOrFail($id);

        return view('accessories.details', ['accessory' => $accessory]);
    }
}
