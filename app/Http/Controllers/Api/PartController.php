<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function index(Request $request)
    {
        $parts = Part::with('car');
        $cars = Car::all();

        if ($request->has('search')) {
            $parts->where('name', 'like', "%" . $request->search . "%")
                ->orWhere('serial_number', 'like', "%" . $request->search . "%");
        }

        if($request->has('cars_search')){
            $parts->where('car_id', $request->cars_search);
        }

        $parts = $parts->get();

        return response()->json([
            'parts' => $parts,
            'cars' => $cars
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:parts,serial_number',
            'car_id' => 'required|exists:cars,id',
        ]);

        $part = Part::create([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'car_id' => $request->car_id,
        ]);

        return response()->json($part, 201);
    }

    public function show(Part $part)
    {
        $part->load('car');
        return response()->json($part);
    }

    public function update(Request $request, Part $part)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:parts,serial_number,' . $part->id,
            'car_id' => 'required|exists:cars,id',
        ]);

        $part->update([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'car_id' => $request->car_id,
        ]);
        
        return response()->json($part);
    }

    public function destroy(Part $part)
    {
        $part->delete();
        return response()->json(null, 204);
    }
}