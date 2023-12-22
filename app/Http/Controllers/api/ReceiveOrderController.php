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
        // $request->subTotal;
        // $request->sub_store_id;
        // $request->orderMobile_id;
        // $request->storeMobile_id;

        $newOrder = StoreOrder::create([
            'subTotal' => $request->subTotal,
            'date' => Carbon::now(),
            'orderMobile_id' => $request->orderMobile_id,
            'storeMobile_id' => $request->orderMobile_id,
            'sub_store_id' => $request->sub_store_id,
        ]);

        return response()->json($newOrder);
    }
}
