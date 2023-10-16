<?php

namespace App\Http\Controllers;

use App\Models\SuportingDocument;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class SuportingDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SuportingDocument::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $suportingDocument = SuportingDocument::create($request->all());
        return response()->json(['suportingDocument'=> $suportingDocument], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(SuportingDocument $suportingDocument)
    {
        return $suportingDocument;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuportingDocument $suportingDocument)
    {
        $suportingDocument->update($request->all());
        return response()->json(['suportingDocument'=> $suportingDocument], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuportingDocument $suportingDocument)
    {
        //
    }
}
