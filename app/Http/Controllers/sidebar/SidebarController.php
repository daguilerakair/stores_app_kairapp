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
        $storeProducts = session('selectedSubStore');

        if ($storeProducts) {
            $storeProducts = $storeProducts->productStore()->get();
        } else {
            $storeProducts = null;
        }

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

    public function ordersManagementIndex()
    {
        return view('sidebarScreens.ordersManagement.index');
    }
}
