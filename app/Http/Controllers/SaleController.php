<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Sale::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sale = Sale::create($request->all());
        return response()->json(['sale'=> $sale], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return $sale;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $sale->update($request->all());
        return response()->json(['sale'=> $sale], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return response()->json(['sale'=> $sale], Response::HTTP_ACCEPTED);
    }
}
