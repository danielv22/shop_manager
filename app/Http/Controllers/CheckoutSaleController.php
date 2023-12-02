<?php

namespace App\Http\Controllers;

use App\Models\CheckoutSale;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $checkoutSale = CheckoutSale::create($request->all());
        return response()->json(['checkoutSale' => $checkoutSale], Response::HTTP_CREATED);
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
        return response()->json(['checkoutSale' => $checkoutSale], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CheckoutSale $checkoutSale)
    {
        $checkoutSale->update(['state' => 0]);
        return response()->json(['action_status' => Response::HTTP_ACCEPTED]);
    }
}
