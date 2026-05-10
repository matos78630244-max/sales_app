<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable = ['customer_id', 'status', 'total', 'notes', 'ordered_at'];

    protected $casts = [
        'total'      => 'decimal:2',
        'ordered_at' => 'datetime',
    ];

    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => match ($this->status) {
                'pending'    => 'Pendiente',
                'processing' => 'En proceso',
                'completed'  => 'Completado',
                'cancelled'  => 'Cancelado',
            }
        );
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
