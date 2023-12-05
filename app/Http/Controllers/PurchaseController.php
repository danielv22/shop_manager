<?php

namespace App\Http\Controllers;

use App\Models\CheckoutPurchase;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\StockPurchase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchase = Purchase::where('state',1)->get();
        $list=[];
        foreach ($purchase as $p){
            $list[] = $this->show($p);
        }
        return $list;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $purchase = new Purchase();
        $purchase->total = $request->total;
        $purchase->type = $request->type;
        $purchase->provider = $request->provider;
        $purchase->motive = $request->motive;
        $purchase->save();
        $number = Purchase::all()->count()+1;
        if(isset($request->cart)){
            if(!empty($request->cart)){
                foreach ($request->cart as $m){
                    $product = $m['product'];
                    $stock = new Stock();
                    $stock->product_id = $product['id'];
                    $stock->type = 1;
                    $stock->purchase_price = $product['purchase_price'];
                    $stock->sale_price = $product['sale_price'];
                    $stock->amount = $m['amount'];
                    $stock->reason = "COMPRA #".$number;
                    $stock->save();
                    $stockPurchase = new StockPurchase();
                    $stockPurchase->stock_id = $stock->id;
                    $stockPurchase->purchase_id = $purchase->id;
                    $stockPurchase->amount = $m['amount'];
                    $stockPurchase->price = $m['price'];
                    $stockPurchase->save();
                }
            }
        }

        $CheckoutPurchase = new CheckoutPurchase();
        $CheckoutPurchase->checkout_id = $request->checkout_id;
        $CheckoutPurchase->purchase_id = $purchase->id;
        $CheckoutPurchase->value = $request->total;
        $CheckoutPurchase->save();

        return response()->json(['purchase'=> $purchase], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        $purchase->stockPurchase = $purchase->stockPurchase()->with(['stock'=>function($i){
            $i->with(['product'=>function($p){
                $p->with(['brand','category','measurement']);
            }]);
        }])->get();
        $purchase->date = $purchase->created_at->format('y-m-d');
        return $purchase;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        $purchase->update($request->all());
        return response()->json(['purchase'=> $purchase], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->update(['state'=>0]);
        $purchase->save();
        return response()->json(['purchase'=> $purchase], Response::HTTP_ACCEPTED);
    }
}
