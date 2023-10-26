<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UserStoresTableSeeder::class);
        $this->call(SubStoreTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(StoreProductsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductCategoryTableSeeder::class);
    }
}
