<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Product Model.
 *
 * @property int         $id
 * @property string      $name
 * @property string|null $productMobileId
 * @property string      $description
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'variablePrice',
        'productMobileId',
        'description',
        'store_rut',
    ];

    public function productImages()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function firstProductImages()
    {
        return $this->hasMany(ProductImages::class, 'product_id')->first();
    }

    public function category()
    {
        return $this->hasMany(ProductCategory::class, 'product_id');
    }
}
