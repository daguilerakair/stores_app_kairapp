<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\StoreProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Update the form for creating a new resource.
     */
    public function update($id)
    {
        // dd($id);

        $storeProduct = StoreProduct::find($id);

        if ($storeProduct) {
            return view('sidebarScreens.inventoryManagement.product.edit', [
                'selectStoreProduct' => $storeProduct,
            ]);
        }

        return back();

        // dd('desde create');
    }

    public function create()
    {
        // dd('desde create');
        return view('sidebarScreens.inventoryManagement.product.create');
    }
}
