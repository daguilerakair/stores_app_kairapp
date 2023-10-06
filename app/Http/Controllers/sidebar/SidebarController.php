<?php

namespace App\Http\Controllers\sidebar;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SidebarController extends Controller
{
    public function ordersIndex()
    {

        // dd('desde orders index');

    }

    public function inventoryManagementIndex()
    {
        $storeProducts = session('store')->productStore()->get();

        return view('sidebarScreens.inventoryManagement.index', compact('storeProducts'));
    }
}
