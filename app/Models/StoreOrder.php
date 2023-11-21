<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * StoreOrder Model.
 *
 * @property int $id
 * @property int $total
 * @property int $order_id
 * @property int $subStore_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|StoreOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreOrder query()
 */
class StoreOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subTotal',
        'date',
        'orderMobile_id',
        'storeMobile_id',
        'sub_store_id',
    ];

    public function subStoreDates()
    {
        return $this->belongsTo(SubStore::class, 'sub_store_id');
    }
}
