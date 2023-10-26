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
            'companyName' => 'Chocolates Juanita Spa',
            'fantasyName' => 'Chocolates Juanita',
            'pathProfile' => 'https://previews.123rf.com/images/rickdeacon/rickdeacon1607/rickdeacon160700264/60279698-un-tiro-de-una-tienda-de-chocolates-spr%C3%BCngli.jpg',
            'pathBackground' => 'https://previews.123rf.com/images/rickdeacon/rickdeacon1607/rickdeacon160700264/60279698-un-tiro-de-una-tienda-de-chocolates-spr%C3%BCngli.jpg',
            'storeMobileId' => 'inupQN9fF1xrftatAbc1',
        ]);

        Store::create([
            'rut' => 65555321,
            'checkDigit' => 'K',
            'companyName' => 'Flores Norte LTDA',
            'fantasyName' => 'Floreria Norte',
            'pathProfile' => 'https://www.vegamonumental.cl/wp-content/uploads/2019/07/IMG_20190719_115942-600x400.jpg',
            'pathBackground' => 'https://previews.123rf.com/images/rickdeacon/rickdeacon1607/rickdeacon160700264/60279698-un-tiro-de-una-tienda-de-chocolates-spr%C3%BCngli.jpg',
            'storeMobileId' => 'XpiQN9fF1xrftatAbc1',
        ]);

        // Store::create([
        //     'rut' => 72432109,
        //     'checkDigit' => '5',
        //     'name' => 'Pulseras Antofagasta',
        //     'address' => 'Prat 8022',
        //     'latitude' => '-23.4776',
        //     'longitude' => '-29.3333',
        //     'pathProfile' => 'https://www.vegamonumental.cl/wp-content/uploads/2019/07/IMG_20190719_115942-600x400.jpg',
        //     'pathBackground' => 'https://previews.123rf.com/images/rickdeacon/rickdeacon1607/rickdeacon160700264/60279698-un-tiro-de-una-tienda-de-chocolates-spr%C3%BCngli.jpg',
        //     'storeMobileId' => 'QziIoN9fF1xrftatDfe4',
        // ]);

        Store::create([
            'rut' => 77563123,
            'checkDigit' => '4',
            'companyName' => 'Giftify Spa',
            'fantasyName' => 'Kairapp',
            'pathProfile' => 'https://www.vegamonumental.cl/wp-content/uploads/2019/07/IMG_20190719_115942-600x400.jpg',
            'pathBackground' => 'https://previews.123rf.com/images/rickdeacon/rickdeacon1607/rickdeacon160700264/60279698-un-tiro-de-una-tienda-de-chocolates-spr%C3%BCngli.jpg',
        ]);
    }
}
