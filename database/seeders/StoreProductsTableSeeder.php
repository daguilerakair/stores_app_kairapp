<?php

namespace Database\Seeders;

use App\Models\StoreProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'storeMobileId' => 'XpiQN9fF1xrftatAbc1',
            'productMobileId' => 'ANJLLSASDWD32',
            'store_rut' => 65555321,
            'product_id' => 1
        ]);

        StoreProduct::create([
            'stock' => 45,
            'price' => 15000,
            'status' => true,
            'storeMobileId' => 'XpiQN9fF1xrftatAbc1',
            'productMobileId' => 'LLKJUKJUOY4996',
            'store_rut' => 65555321,
            'product_id' => 2
        ]);
    }
}
