<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;  

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    /**hola */
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description'];

    protected $casts = ['created_at' => 'datetime'];

    protected function formattedName(): Attribute
    {
    return Attribute::make(
        get: fn () => strtoupper($this->name)
    );
    }

    public function products()
    {
    return $this->hasMany(Product::class);
    }
}
