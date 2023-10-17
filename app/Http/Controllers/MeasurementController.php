<?php

namespace App\Http\Controllers;

use App\Models\measurement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return measurement::where('state',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $measurement = measurement::create($request->all());
        return response()->json(['measurement'=> $measurement], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(measurement $measurement)
    {
        return $measurement;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, measurement $measurement)
    {
        $measurement->update($request->all());
        return response()->json(['measurement'=> $measurement], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(measurement $measurement)
    {
        $measurement->update(['state'=>0]);
        return response()->json(['measurement'=> $measurement], Response::HTTP_ACCEPTED);
    }
}
