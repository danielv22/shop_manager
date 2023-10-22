<?php

namespace App\Http\Controllers;

use App\Models\CheckoutPurchase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CheckoutPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CheckoutPurchase::with([
            'Checkout',
            'Purchase'
        ])->where('state', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $checkout_purchase = CheckoutPurchase::create($request->all());
        return response()->json(['brand'=> $checkout_purchase], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(CheckoutPurchase $checkoutPurchase)
    {
        $checkoutPurchase->checkout = $checkoutPurchase->Checkout;
        $checkoutPurchase->purchase = $checkoutPurchase->Purchase;
        return $checkoutPurchase;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CheckoutPurchase $checkoutPurchase)
    {
        $checkout_purchase = $checkoutPurchase->update($request->all());
        return response()->json(['$checkout_purchase'=> $checkout_purchase], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CheckoutPurchase $checkoutPurchase)
    {
        $checkoutPurchase->update(['state' => 0]);
        return response()->json(['action' => Response::HTTP_ACCEPTED]);
    }
}
