<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price'];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function categories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
