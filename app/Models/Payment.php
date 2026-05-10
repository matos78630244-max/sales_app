<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;
    protected $fillable = ['order_id', 'method', 'amount', 'status', 'paid_at'];

    protected $casts = [
        'amount'  => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    protected function methodLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => match ($this->method) {
                'cash'     => 'Efectivo',
                'card'     => 'Tarjeta',
                'transfer' => 'Transferencia',
            }
        );
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
