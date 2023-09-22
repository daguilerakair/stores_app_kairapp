<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

    protected $table = 'stores';
    protected $primaryKey = 'rut';
    public $incrementing = false;

    use HasFactory;

    protected $fillable = [
        'rut',
        'name',
        'address',
        'latitude',
        'length',
        'pathImage',
        'storeMobileId'
    ];

    public function productStore()
    {
        return $this->hasMany(StoreProduct::class, 'store_rut');
    }
}
