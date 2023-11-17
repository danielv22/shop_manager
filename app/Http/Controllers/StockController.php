<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = Product::where('state',1)->get();
        $list=[];
        foreach ($model as $m){
            $list[] = $this->kardex($m);
        }

        return $list;
    }
    public function kardex(Product $product)
    {
        $product->brand = $product->Brand;
        $product->measurement = $product->Measurement;
        $product->category = $product->Category;
        $product->stocks = $product->stocks()->where('state',1)->get();
        $product->income = $product->stocks->where('type',1)->sum('amount');
        $product->expenses = $product->stocks->where('type',2)->sum('amount');
        $product->stock = $product->income - $product->expenses;
        $product->valued = $product->stock * $product->purchase_price;
        $product->investment= $product->stock * $product->sale_price;
        $product->gain = $product->valued - $product->investment;
        return $product;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $stock = new Stock();
        $stock->product_id = $request->product_id;
        $stock->type = $request->type;
        $stock->purchase_price = $request->purchase_price;
        $stock->sale_price = $request->sale_price;
        $stock->amount = $request->amount;
        $stock->reason = $request->reason;
        $stock->save();
        return response()->json(['stock' => $stock], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        $stock->product = $stock->Product;
        return $stock;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        $stock->update($request->all());
        return response()->json(['stock' => $stock], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->update(['state' => 0]);
        $stock->save();
        return response()->json(['action_status' => Response::HTTP_ACCEPTED]);
    }
}
