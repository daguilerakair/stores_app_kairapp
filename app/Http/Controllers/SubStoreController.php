<?php

namespace App\Http\Controllers;

class SubStoreController extends Controller
{
    public function obtainSubStores()
    {
        $subStores = session('store')->subStores()->get();

        return response()->json([
            'subStores' => $subStores,
        ]);
    }
}
