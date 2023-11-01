<?php

namespace App\Http\Controllers;

use App\Models\CheckoutActivity;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckoutActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CheckoutActivity::with(['checkout'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $checkoutActivity = CheckoutActivity::create($request->all());
        return response()->json(['checkout_activity' => $checkoutActivity], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(CheckoutActivity $checkoutActivity)
    {
        $checkoutActivity->checkout = $checkoutActivity->Checkout;
        return $checkoutActivity;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CheckoutActivity $checkoutActivity)
    {
        $checkoutActivity->update($request->all());
        return response()->json(['checkout_activity' => $checkoutActivity], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CheckoutActivity $checkoutActivity)
    {
        $checkoutActivity->delete();
    }
}
