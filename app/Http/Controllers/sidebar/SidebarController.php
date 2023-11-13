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
        $subStoreProducts = session('selectedSubStore');
        $selectedOption = 0;
        if ($subStoreProducts) {
            // dd($subStoreProducts);
            $subStoreProducts = $subStoreProducts->productStore()->get();
        } else {
            $subStoreProducts = null;
        }

        return view('sidebarScreens.inventoryManagement.index', compact('subStoreProducts', 'selectedOption'));
    }

    public function inventoryManagementIndexSelected($id)
    {
        $subStoreProducts = session('selectedSubStore');
        $selectedOption = $id;
        if ($subStoreProducts) {
            $subStoreProducts = $subStoreProducts->productStore()->get();
        } else {
            $subStoreProducts = null;
        }

        return view('sidebarScreens.inventoryManagement.index', compact('subStoreProducts', 'selectedOption'));
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

    public function supportIndex()
    {
        return view('sidebarScreens.support.index');
    }
}
