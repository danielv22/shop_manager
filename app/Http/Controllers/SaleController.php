<?php

namespace App\Http\Controllers;

use App\Models\CheckoutSale;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\SaleStock;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sale = Sale::where('status', 1)->get();
        $list=[];
        foreach ($sale as $p){
            $list[] = $this->show($p);
        }
        return $list;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sale = new Sale();
        $sale->total = $request->total;
        $sale->pay = $request->pay;
        $sale->exchange = $request->change;
        $sale->type = $request->type;
        $sale->reason = $request->reason;
        $sale->client = $request->client;
        $sale->save();

        $number = Sale::all()->count() + 1;

        if (isset($request->cart)) {
            if (!empty($request->cart)) {
                foreach ($request->cart as $m) {
                    $product = $m['product'];
                    $stock = new Stock();
                    $stock->product_id = $product['id'];
                    $stock->amount = $m['amount'];
                    $stock->type = 2; // Va descontando.
                    $stock->purchase_price = $product['purchase_price'];
                    $stock->sale_price = $product['sale_price'];
                    $stock->reason = "Venta #" . $number;
                    $stock->save();

                    $stockSale = new SaleStock();
                    $stockSale->sale_id = $sale->id;
                    $stockSale->stock_id = $stock->id;
                    $stockSale->amount = $m['amount'];
                    $stockSale->price = $m['price'];
                    $stockSale->save();
                }
            }
        }
        return response()->json(['sale'=> $sale], Response::HTTP_CREATED);
        if(isset($request->checkout_id)){
            $checkoutSale = new CheckoutSale();
            $checkoutSale->checkout_id = $request->checkout_id;
            $checkoutSale->sale_id = $sale->id;
            $checkoutSale->value = $sale->total;
            $checkoutSale->save();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $sale->stockSale = $sale->saleStock()->with(['stock' => function($i) {
            $i->with(['product'=>function($p){
                $p->with(['brand','category','measurement']);
            }]);
        }])->get();
        $sale->date = $sale->created_at->format('Y-m-d');
        return $sale;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $sale->update($request->all());
        return response()->json(['sale' => $sale], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->update(['status'=>0]);
        $sale->save();
        return response()->json(['purchase'=> $sale], Response::HTTP_ACCEPTED);
    }
}
