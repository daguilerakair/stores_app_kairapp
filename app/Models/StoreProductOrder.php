<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * StoreProductOrder Model.
 *
 * @property int $id
 * @property int $quantity
 * @property int $price
 * @property int $order_id
 * @property int $store_product_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|StoreProductOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreProductOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreProductOrder query()
 */
class StoreProductOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quantity',
        'buyPrice',
        'note',
        'productMobile_id',
        'store_order_id',
        'sub_store_product_id',
    ];

    public function subStoreProductDates()
    {
        return $this->belongsTo(SubStoreProduct::class, 'sub_store_product_id');
    }
}
