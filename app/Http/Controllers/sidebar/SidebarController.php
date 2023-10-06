<?php

namespace App\Http\Controllers\sidebar;

use App\Http\Controllers\Controller;

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

    public function manageCollaboratorsIndex()
    {
        return view('sidebarScreens.manageCollaborators.index');
    }

    public function storesManagementIndex()
    {
        return view('sidebarScreens.storesManagement.index');
    }
}
