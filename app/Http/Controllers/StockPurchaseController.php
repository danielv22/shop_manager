<?php

namespace App\Http\Controllers;

use App\Models\StockPurchase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StockPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return StockPurchase::with(['stock', 'purchase'])->where('state', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $stockPurchase = StockPurchase::create($request->all());
        return response()->json(['stockPurchase' => $stockPurchase], Response::HTTP_CREATED);
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
        return response()->json(['stockPurchase' => $stockPurchase], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockPurchase $stockPurchase)
    {
        $stockPurchase->update(['state' => 0]);
        return response()->json(['action_status' => Response::HTTP_ACCEPTED]);
    }
}
