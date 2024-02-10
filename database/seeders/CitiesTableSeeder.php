<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ChileCities = [
            ['name' => 'Arica', 'state_id' => 1],
            ['name' => 'Iquique', 'state_id' => 2],
            ['name' => 'Antofagasta', 'state_id' => 3],
            ['name' => 'Calama', 'state_id' => 3],
            ['name' => 'Copiapó', 'state_id' => 4],
            ['name' => 'La Serena', 'state_id' => 5],
            ['name' => 'Coquimbo', 'state_id' => 5],
            ['name' => 'Valparaíso', 'state_id' => 6],
            ['name' => 'Viña del Mar', 'state_id' => 6],
            ['name' => 'Santiago', 'state_id' => 7],
            ['name' => 'Maipú', 'state_id' => 7],
            ['name' => 'Providencia', 'state_id' => 7],
            ['name' => 'Las Condes', 'state_id' => 7],
            // ... otras ciudades ...
            ['name' => 'Punta Arenas', 'state_id' => 15],
        ];
    }
}
