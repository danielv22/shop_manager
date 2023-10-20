<?php

namespace App\Http\Controllers;

use App\Models\StockPurchase;
use Illuminate\Http\Request;

class StockPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return StockPurchase::with([
            'stock',
            'purchase'
        ])->where('state', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        StockPurchase::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(StockPurchase $stockPurchase)
    {
        $stockPurchase->stock = $stockPurchase->Stock;
        $stockPurchase->purchase = $stockPurchase->Purchase;
        return $stockPurchase;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockPurchase $stockPurchase)
    {
        $stockPurchase->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockPurchase $stockPurchase)
    {
        $stockPurchase->update(['state' => 0]);
    }
}
