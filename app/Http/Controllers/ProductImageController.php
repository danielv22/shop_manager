<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $file = $request->file('file')->store('public/products');
        $url = Storage::url($file);
        $image = new Image();
        $image->path = $url;
        $image->save();
        $productImage = new ProductImage();
        $productImage->image_id = $image->id;
        $productImage->product_id = $product->id;
        $productImage->save();
        return $productImage;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->brand = $product->brand;
        $product->category = $product->category;
        $product->productImage = $product->productImage()->get()->each(function ($i){
            $i->url = $i->image->urlImage();
        });
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductImage $productImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductImage $productImage)
    {
        $productImage->state = 0;
        $productImage->save();

    }
}
