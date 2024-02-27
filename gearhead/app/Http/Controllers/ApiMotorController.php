<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motor;

class ApiMotorController extends Controller
{
    public function index()
    {
        return Motor::all();
    }

    public function store(Request $request)
    {
        return Motor::create($request->all());
    }

    public function show(Motor $motor)
    {
        return $motor;
    }

    public function update(Request $request, Motor $motor)
    {
        $motor->update($request->all());
        return $motor;
    }

    public function destroy(Motor $motor)
    {
        $motor->delete();
        return response()->json(null, 204);
    }
}
