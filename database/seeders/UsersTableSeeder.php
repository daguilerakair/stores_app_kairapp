<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Diego Aguilera',
            'email' => 'diego.aguilera.villanelo2@gmail.com',
            'password' => bcrypt('contraseña1'),
        ]);

        User::create([
            'name' => 'Cristian Zepeda',
            'email' => 'cristian@example.com',
            'password' => bcrypt('contraseña2'),
        ]);
    }
}
