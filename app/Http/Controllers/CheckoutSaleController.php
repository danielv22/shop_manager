<?php

namespace App\Http\Controllers;

use App\Models\CheckoutSale;
use Illuminate\Http\Request;

class CheckoutSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CheckoutSale::with([
            'checkout',
            'sale'
        ])->where('state', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        CheckoutSale::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(CheckoutSale $checkoutSale)
    {
        $checkoutSale->checkout = $checkoutSale->Checkout;
        $checkoutSale->sale = $checkoutSale->Sale;
        return $checkoutSale;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CheckoutSale $checkoutSale)
    {
        $checkoutSale->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CheckoutSale $checkoutSale)
    {
        $checkoutSale->update(['state' => 0]);
    }
}
