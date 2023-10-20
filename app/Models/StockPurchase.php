<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_id',
        'purchase_id',
        'price',
        'amount',
        'state'
    ];

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }
}
