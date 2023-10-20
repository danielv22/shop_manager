<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Stock::with([
            'product'
        ])->where('state', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Stock::create($request->all());
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->update(['state' => 0]);
    }
}
