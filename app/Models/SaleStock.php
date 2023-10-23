<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'stock_id',
        'price',
        'amount',
        'state'
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }
    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }
}
