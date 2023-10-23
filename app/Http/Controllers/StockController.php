<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Stock::with(['product'])->where('state', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $stock = Stock::create($request->all());
        return response()->json(['stock' => $stock], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        $stock->product = $stock->Product;
        return $stock;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        $stock->update($request->all());
        return response()->json(['stock' => $stock], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->update(['state' => 0]);
        return response()->json(['stock'=>Response::HTTP_ACCEPTED]);
    }
}
