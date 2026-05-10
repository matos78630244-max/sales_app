<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'sku', 'description', 'price', 'stock', 'active'];

    protected $casts = [
        'price'  => 'decimal:2',
        'stock'  => 'integer',
        'active' => 'boolean',
    ];

    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn() => 'Bs. ' . number_format($this->price, 2)
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
            ->withPivot('quantity', 'unit_price')
            ->withTimestamps();
    }
}
