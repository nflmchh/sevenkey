<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'category',
        'price',
        'cost_price',
        'stock',
        'min_stock',
        'unit',
        'supplier',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function isLowStock()
    {
        return $this->stock <= $this->min_stock;
    }

    public function getProfitMarginAttribute()
    {
        if ($this->cost_price > 0) {
            return (($this->price - $this->cost_price) / $this->cost_price) * 100;
        }
        return 0;
    }

    public function getProfitPercentage()
    {
        if ($this->cost_price > 0) {
            return round((($this->price - $this->cost_price) / $this->cost_price) * 100, 1);
        }
        return 0;
    }

    public function getProfitAmount()
    {
        return $this->price - $this->cost_price;
    }
}
