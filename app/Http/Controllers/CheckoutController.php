<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Checkout::with(['user'])->where('state', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $checkout = Checkout::create($request->all());
        return response()->json(['checkout' => $checkout], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Checkout $checkout)
    {
        $checkout->sales = $checkout->CheckoutSales()->get()->sum('value');
        $checkout->purchases = $checkout->CheckoutPurchases()->get()->sum('value');
        $checkout->activities = $checkout->CheckoutActivity()->get();
        $checkout->revenues =  $checkout->activities->where('type',1)->sum('value');
        $checkout->expenses =  $checkout->activities->where('type',2)->sum('value');
        $checkout->total = floatval($checkout->revenues + $checkout->sales  - $checkout->expenses - $checkout->purchases);
        $checkout->user = $checkout->User;
        return $checkout;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checkout $checkout)
    {
        $checkout->state = 0;
        $checkout->save();

        $new_checkout = new Checkout();
        $new_checkout->user_id = $checkout->user_id;
        $new_checkout->state = 1;
        $new_checkout->save();

        return $new_checkout;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkout $checkout)
    {
        $checkout->update(['state' => 0]);
        return Response::Json(['action' => Response::HTTP_ACCEPTED]);
    }
}
