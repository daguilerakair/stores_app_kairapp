<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubStoreProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock',
        'sub_store_id',
        'store_product_id',
    ];
}
