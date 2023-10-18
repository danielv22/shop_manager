<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Currency::where('state',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currency = Currency::create($request->all());
        return response()->json(['currency'=> $currency], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        return $currency;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency)
    {
        $currency->update($request->all());
        return response()->json(['currency'=> $currency], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        $currency->update(['state'=>0]);
        return response()->json(['currency'=> $currency], Response::HTTP_ACCEPTED);
    }
}
