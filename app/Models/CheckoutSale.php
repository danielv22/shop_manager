<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CheckoutSale extends Model
{
    use HasFactory;

    public function checkout(): BelongsTo
    {
        return $this->belongsTo(Checkout::class);
    }
    public function Sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }
}
