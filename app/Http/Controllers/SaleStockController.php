<?php

namespace App\Http\Controllers;

use App\Models\SaleStock;
use Illuminate\Http\Request;

class SaleStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SaleStock::with([
            'sale',
            'stock'
        ])->where('state', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        SaleStock::create($request->all());
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleStock $saleStock)
    {
        $saleStock->update(['state' => 0]);
    }
}
