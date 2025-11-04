<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $cars = Car::with('parts');

        if ($request->has('registered')) { //ak sa filtruje registered
            $cars->where('is_registered', $request->boolean('registered'));
        }

        if ($request->has('search')) { //ak sa filtruje search
            $cars->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('registration_number', 'like', '%' . $request->search . '%');
        }
        
        $cars = $cars->get(); //netreba paginaciu pri tejto ukážke

        return response()->json($cars);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'nullable|string|max:7|required_if:is_registered,true',
            'is_registered' => 'required|boolean',
        ]);

        $car = Car::create([
            'name' => $request->name,
            'registration_number' => $request->registration_number,
            'is_registered' => $request->is_registered,
        ]);

        return response()->json($car, 201);
    }

    public function show(Car $car)
    {
        $car->load('parts');
        return response()->json($car);
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'nullable|string|max:20|required_if:is_registered,true',
            'is_registered' => 'required|boolean',
        ]);

        $car->update([
            'name' => $request->name,
            'registration_number' => $request->registration_number,
            'is_registered' => $request->is_registered,    
        ]);

        return response()->json($car);
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return response()->json(null, 204);
    }
}