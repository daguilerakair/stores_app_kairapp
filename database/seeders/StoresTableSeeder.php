<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'rut' => 775843575,
            'checkDigit' => '2',
            'name' => 'Chocolates Juanita',
            'address' => 'Angamos 5945',
            'latitude' => '-35.4222',
            'length' => '-32.1233',
            'pathImage' => 'https://previews.123rf.com/images/rickdeacon/rickdeacon1607/rickdeacon160700264/60279698-un-tiro-de-una-tienda-de-chocolates-spr%C3%BCngli.jpg',
            'storeMobileId' => 'inupQN9fF1xrftatAbc1'
        ]);

        Store::create([
            'rut' => 65555321,
            'checkDigit' => 'K',
            'name' => 'Floreria Norte',
            'address' => 'Matta 4022',
            'latitude' => '-29.4776',
            'length' => '-25.3333',
            'pathImage' => 'https://www.vegamonumental.cl/wp-content/uploads/2019/07/IMG_20190719_115942-600x400.jpg',
            'storeMobileId' => 'XpiQN9fF1xrftatAbc1'
        ]);
    }
}
