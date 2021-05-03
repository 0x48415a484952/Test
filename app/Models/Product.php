<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'special_price_rule'
    ];

    public function inStock()
    {
        return $this->stockCount() > 0;
    }

    public function stockCount()
    {
        // return $this->stock->sum('pivot.stock');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function minStock($count)
    {
        return min($this->stockCount(), $count);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
