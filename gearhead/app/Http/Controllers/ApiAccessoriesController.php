<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accessories;

class ApiAccessoriesController extends Controller
{
    public function index()
    {
        $accessories = Accessories::all();
        return response()->json($accessories);
    }

    public function store(Request $request)
    {
        $accessory = Accessories::create($request->all());
        return response()->json($accessory, 201);
    }

    public function show($id)
    {
        $accessory = Accessories::findOrFail($id);
        return response()->json($accessory);
    }

    public function update(Request $request, $id)
    {
        $accessory = Accessories::findOrFail($id);
        $accessory->update($request->all());
        return response()->json($accessory, 200);
    }

    public function destroy($id)
    {
        Accessories::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
