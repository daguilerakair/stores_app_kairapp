<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Floreria',
        ]);

        Category::create([
            'name' => 'Juguetes',
        ]);

        Category::create([
            'name' => 'Tecnologia',
        ]);

        Category::create([
            'name' => 'Comida',
        ]);

        Category::create([
            'name' => 'Ropa',
        ]);

        Category::create([
            'name' => 'Chocolates',
        ]);
    }
}
