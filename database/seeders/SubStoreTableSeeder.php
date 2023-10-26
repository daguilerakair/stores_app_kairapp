<?php

namespace Database\Seeders;

use App\Models\SubStore;
use Illuminate\Database\Seeder;

class SubStoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Floreria del Norte Substores
        SubStore::create([
            'name' => 'Floreria Norte Pedro Aguirre Cerda',
            'address' => 'Matta 4022',
            'latitude' => '-74.4776',
            'longitude' => '-45.3333',
            'phone' => 56987345632,
            'subStoreMobileId' => 'AYOcf9vm1wuaikAbd5',
            'store_rut' => 65555321,
        ]);

        // Chocolates Juanita SubStores
        SubStore::create([
            'name' => 'Chocolates Juanita Angamos Sector Sur',
            'address' => 'Angamos 5945',
            'latitude' => '-35.4222',
            'longitude' => '-32.1233',
            'phone' => 56965239076,
            'subStoreMobileId' => 'puniQK9fF1xrftatAbc1',
            'store_rut' => 77584357,
        ]);

        SubStore::create([
            'name' => 'Chocolates Juanita Bonilla Sector Norte',
            'address' => 'Angamos 5945',
            'latitude' => '-60.4222',
            'longitude' => '-42.1233',
            'phone' => 56976432188,
            'subStoreMobileId' => 'komiQN9Aa1stfeatDef1',
            'store_rut' => 77584357,
        ]);
    }
}
