<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'barcode',
        'brand_id',
        'measurement_id',
        'category_id',
        'purchase_price',
        'sale_price',
        'minimum_stock',
        'state'
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    public function measurement(): BelongsTo
    {
        return $this->belongsTo(measurement::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function productImage()
    {
        return $this->hasMany(ProductImage::class)->with(['Image'])->where("state",1)->orderBy('id','desc');
    }
}
