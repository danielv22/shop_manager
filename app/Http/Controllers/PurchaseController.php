<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Purchase::where('state',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $purchase = Purchase::create($request->all());
        return response()->json(['purchase'=> $purchase], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        return $purchase;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        $purchase->update($request->all());
        return response()->json(['purchase'=> $purchase], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->update(['state'=>0]);
        return response()->json(['purchase'=> $purchase], Response::HTTP_ACCEPTED);
    }
}
