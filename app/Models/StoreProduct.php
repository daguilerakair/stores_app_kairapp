<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock',
        'price',
        'status',
        'storeMobileId',
        'productMobileId',
        'store_rut',
        'product_id'
    ];

    public function productDates()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
