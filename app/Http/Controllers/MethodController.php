<?php

namespace App\Http\Controllers;

use App\Models\Method;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Method::where('state',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $method = Method::create($request->all());
        return response()->json(['method'=> $method], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Method $method)
    {
        return $method;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Method $method)
    {
        $method->update($request->all());
        return response()->json(['method'=> $method], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Method $method)
    {
        $method->update(['state'=>0]);
        return response()->json(['method'=> $method], Response::HTTP_ACCEPTED);
    }
}
