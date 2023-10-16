<?php

namespace App\Http\Controllers;

use App\Models\Invoicing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoicingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Invoicing::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $invoicing = Invoicing::create($request->all());
        return response()->json(['invoicing'=> $invoicing], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoicing $invoicing)
    {
        return $invoicing;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoicing $invoicing)
    {
        $invoicing->update($request->all());
        return response()->json(['invoicing'=> $invoicing], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoicing $invoicing)
    {
        $invoicing->delete();
        return response()->json(['invoicing'=> $invoicing], Response::HTTP_ACCEPTED);
    }
}
