<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Diego Aguilera',
            'email' => 'diego.aguilera@gmail.com',
            'password' => bcrypt('contraseña1'),
            'temporary_password' => false,
        ]);

        User::create([
            'name' => 'Cristian Zepeda',
            'email' => 'cristian@example.com',
            'password' => bcrypt('contraseña2'),
            'temporary_password' => false,
        ]);

        User::create([
            'name' => 'Kairapp',
            'email' => 'kairapp@kairapp.com',
            'password' => bcrypt('kairapp2023'),
            'temporary_password' => false,
        ]);
    }
}
