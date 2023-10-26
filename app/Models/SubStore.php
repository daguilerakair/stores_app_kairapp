<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * SubStore Model.
 *
 * @property int         $id
 * @property int         $rut
 * @property string      $checkDigit
 * @property string      $name
 * @property string      $address
 * @property float       $latitude
 * @property float       $longitude
 * @property int         $phone
 * @property string      $pathProfile
 * @property string      $pathBackground
 * @property string|null $storeMobileId
 * @property int         $store_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SubStore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubStore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubStore query()
 *
 * @property \Illuminate\Database\Eloquent\Collection|StoreProduct[] $productStore
 * @property int|null                                                $product_store_count
 */
class SubStore extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'phone',
        'store_rut',
    ];

    /**
     * Get the products associated with the substore.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productStore()
    {
        return $this->hasMany(StoreProduct::class, 'substore_id');
    }
}
