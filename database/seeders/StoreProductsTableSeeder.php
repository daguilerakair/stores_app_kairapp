<?php

namespace Database\Seeders;

use App\Models\StoreProduct;
use Illuminate\Database\Seeder;

class StoreProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreProduct::create([
            'stock' => 100,
            'price' => 11500,
            'status' => true,
            'delete' => false,
            'storeMobileId' => 'XpiQN9fF1xrftatAbc1',
            'productMobileId' => 'ANJLLSASDWD32',
            'substore_id' => 1,
            'product_id' => 1,
        ]);

        StoreProduct::create([
            'stock' => 45,
            'price' => 15000,
            'status' => true,
            'delete' => false,
            'storeMobileId' => 'XpiQN9fF1xrftatAbc1',
            'productMobileId' => 'LLKJUKJUOY4996',
            'substore_id' => 1,
            'product_id' => 2,
        ]);
    }
}
