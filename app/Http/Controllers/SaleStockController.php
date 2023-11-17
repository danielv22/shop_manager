<?php

namespace App\Http\Controllers;

use App\Models\SaleStock;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SaleStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SaleStock::with(['sale', 'stock'])->where('state', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $saleStock = SaleStock::create($request->all());
        return response()->json(['saleStock' => $saleStock], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleStock $saleStock)
    {
        $saleStock->sale = $saleStock->Sale;
        $saleStock->stock = $saleStock->Stock;
        return $saleStock;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SaleStock $saleStock)
    {
        $saleStock->update($request->all());
        return response()->json(['saleStock' => $saleStock], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleStock $saleStock)
    {
        $saleStock->update(['state' => 0]);
        return response()->json(['action_status' => Response::HTTP_ACCEPTED]);
    }
}
