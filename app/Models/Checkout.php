<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'state'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function CheckoutSales(){
        return $this->hasMany(CheckoutSale::class)->where('state',1);
    }
    public function CheckoutPurchases(){
        return $this->hasMany(CheckoutPurchase::class);
    }
    public function CheckoutActivity(){
        return $this->hasMany(CheckoutActivity::class);
    }
}
