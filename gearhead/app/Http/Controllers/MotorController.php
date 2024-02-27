<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motor;

class MotorController extends Controller
{
    public function index()
    {
        // Retrieve all motorcycles for the general catalog
        $motors = Motor::all();

        // Retrieve unique brands for the dropdown
        $brands = Motor::distinct('brand')->pluck('brand');

        return view('motor', compact('motors', 'brands'));
    }

    public function showByBrand($brand)
    {
        // Retrieve motorcycles based on the specified brand
        $motors = Motor::where('brand', $brand)->get();

        return view('brand', compact('motors', 'brand'));
    }

    public function showDetails($id)
    {
        $motor = Motor::findOrFail($id);

        return view('motordetails', ['motor' => $motor]);
    }

}
