<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStore extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_rut',
        'role_id',
        'status',
        'delete',
    ];

    public function storeInfo()
    {
        return $this->belongsTo(Store::class, 'store_rut');
    }

    public function roleUser()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function userInfo()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
