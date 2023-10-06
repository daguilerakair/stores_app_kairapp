<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'rut' => 77584357,
            'checkDigit' => '2',
            'name' => 'Chocolates Juanita',
            'address' => 'Angamos 5945',
            'latitude' => '-35.4222',
            'length' => '-32.1233',
            'pathImage' => 'https://previews.123rf.com/images/rickdeacon/rickdeacon1607/rickdeacon160700264/60279698-un-tiro-de-una-tienda-de-chocolates-spr%C3%BCngli.jpg',
            'storeMobileId' => 'inupQN9fF1xrftatAbc1',
        ]);

        Store::create([
            'rut' => 65555321,
            'checkDigit' => 'K',
            'name' => 'Floreria Norte',
            'address' => 'Matta 4022',
            'latitude' => '-29.4776',
            'length' => '-25.3333',
            'pathImage' => 'https://www.vegamonumental.cl/wp-content/uploads/2019/07/IMG_20190719_115942-600x400.jpg',
            'storeMobileId' => 'XpiQN9fF1xrftatAbc1',
        ]);

        Store::create([
            'rut' => 72432109,
            'checkDigit' => '5',
            'name' => 'Pulseras Antofagasta',
            'address' => 'Prat 8022',
            'latitude' => '-23.4776',
            'length' => '-29.3333',
            'pathImage' => 'https://www.vegamonumental.cl/wp-content/uploads/2019/07/IMG_20190719_115942-600x400.jpg',
            'storeMobileId' => 'QziIoN9fF1xrftatDfe4',
        ]);

        Store::create([
            'rut' => 77563123,
            'checkDigit' => '4',
            'name' => 'Kairapp',
            'address' => 'Matta 2302',
            'latitude' => '-20.4776',
            'length' => '-24.333',
            'pathImage' => 'https://www.vegamonumental.cl/wp-content/uploads/2019/07/IMG_20190719_115942-600x400.jpg',
            'storeMobileId' => 'KwiIoN9axc1fkjek4',
        ]);
    }
}
