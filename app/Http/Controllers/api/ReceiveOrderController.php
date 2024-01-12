<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\StoreOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReceiveOrderController extends Controller
{
    public function index()
    {
        return response()->json('mensaje');
    }

    public function store(Request $request)
    {
        // {
        //     "ammount": 65321,
        //     "date": "2023-10-30",
        //     "shopping_cart": [
        //         {
        //             "price": 25990,
        //             "productMobileId": "IAGL3OQwbsAzTmIQhWeM",
        //             "storeMobileId": "KPTedOgPuvra33JOa4YL",
        //             "quantity": 1
        //         },
        //         {
        //             "price": 40000,
        //             "productMobileId": "mYyFIgFtnpWcDFYFH8ou",
        //             "storeMobileId": "KPTedOgPuvra33JOa4YL",
        //             "quantity": 1
        //         }
        //     ]
        // }

        // $request->subTotal;
        // $request->sub_store_id;
        // $request->orderMobile_id;
        // $request->storeMobile_id;

        // $newOrder = StoreOrder::create([
        //     'subTotal' => $request->subTotal,
        //     'date' => Carbon::now(),
        //     'orderMobile_id' => $request->orderMobile_id,
        //     'storeMobile_id' => $request->orderMobile_id,
        //     'sub_store_id' => $request->sub_store_id,
        // ]);

        // Decodificamos el JSON a un array PHP
        // $data = json_decode($json, true);

        // Creamos un array vacío para almacenar los precios
        $precios = [];

        // Extraemos la fecha de la orden
        $dateOrder = $request->date;

        $data = $request->json()->all();
        // Iteramos sobre el array 'shopping_cart' y almacenamos los precios
        foreach ($data['shopping_cart'] as $item) {
            $precios[] = $item['productMobileId'];
        }

        $precios[] = $dateOrder;

        // Retornamos los precios en una respuesta JSON
        return response()->json($precios);
    }
}
