<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';
    protected $primaryKey = 'rut';
    public $incrementing = false;

    protected $fillable = [
        'rut',
        'checkDigit',
        'name',
        'address',
        'latitude',
        'length',
        'pathImage',
        'storeMobileId',
    ];

    public function productStore()
    {
        return $this->hasMany(StoreProduct::class, 'store_rut');
    }

    public function userStore()
    {
        return $this->hasMany(UserStore::class, 'store_rut');
    }

    public function searchUserStore($user_id)
    {
        return $this->hasMany(UserStore::class, 'store_rut')->where('user_id', $user_id)->first();
    }
}
