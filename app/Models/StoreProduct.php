<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * StoreProduct Model.
 *
 * @property int                         $id
 * @property int                         $stock
 * @property int                         $price
 * @property bool                        $status
 * @property bool                        $delete
 * @property string|null                 $storeMobileId
 * @property string|null                 $productMobileId
 * @property int                         $substore_id
 * @property int                         $product_id
 * @property \App\Models\Product         $productDates
 * @property \App\Models\ProductCategory $categoryDates
 *
 * @method static \Illuminate\Database\Eloquent\Builder|StoreProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreProduct query()
 */
class StoreProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'stock',
        'price',
        'status',
        'delete',
        'storeMobileId',
        'productMobileId',
        'substore_id',
        'product_id',
    ];

    /**
     * Get the associated product dates for the store product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productDates()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Get the associated category dates for the store product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoryDates()
    {
        return $this->belongsTo(ProductCategory::class, 'product_id');
    }
}
