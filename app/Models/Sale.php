<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'pay',
        'exchange'
    ];

    public function saleStock(): HasMany
    {
        return $this->hasMany(SaleStock::class);
    }

    public function checkoutSale(): HasMany
    {
        return $this->hasMany(CheckoutSale::class);
    }
}
