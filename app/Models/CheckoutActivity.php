<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CheckoutActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'checkout_id',
        'type',
        'value',
        'motive'

    ];
    public function checkout(): BelongsTo
    {
        return $this->belongsTo(Checkout::class);
    }
}
