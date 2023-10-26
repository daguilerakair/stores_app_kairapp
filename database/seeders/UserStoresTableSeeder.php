<?php

namespace Database\Seeders;

use App\Models\UserStore;
use Illuminate\Database\Seeder;

class UserStoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserStore::create([
            'user_id' => 1,
            'store_rut' => 65555321,
            'subStore_id' => null,
            'role_id' => 2,
            'status' => 1,
            'delete' => 0,
        ]);

        UserStore::create([
            'user_id' => 1,
            'store_rut' => 77584357,
            'subStore_id' => 2,
            'role_id' => 4,
            'status' => 1,
            'delete' => 0,
        ]);

        UserStore::create([
            'user_id' => 3,
            'store_rut' => 77563123,
            'subStore_id' => null,
            'role_id' => 1,
            'status' => 1,
            'delete' => 0,
        ]);
    }
}
