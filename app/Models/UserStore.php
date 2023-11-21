<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * UserStore Model.
 *
 * @property int  $id
 * @property int  $user_id
 * @property int  $store_rut
 * @property int  $subStore_id
 * @property int  $role_id
 * @property bool $status
 * @property bool $delete
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserStore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStore query()
 *
 * @property \App\Models\Store $storeInfo
 * @property \App\Models\Role  $roleUser
 * @property \App\Models\User  $userInfo
 */
class UserStore extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'store_rut',
        'subStore_id',
        'role_id',
        'status',
        'delete',
        'admin',
    ];

    /**
     * Get the store information associated with the user store.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function storeInfo()
    {
        return $this->belongsTo(Store::class, 'store_rut');
    }

    /**
     * Get the role information associated with the user store.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roleUser()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function subStoreUser()
    {
        return $this->belongsTo(SubStore::class, 'subStore_id');
    }

    /**
     * Get the user information associated with the user store.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userInfo()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
