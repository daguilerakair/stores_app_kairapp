<?php

namespace Database\Seeders;

use App\Models\UserStore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'role_id' => 1,
        ]);

        UserStore::create([
            'user_id' => 1,
            'store_rut' => 775843575,
            'role_id' => 2,
        ]);
    }
}
