<?php

namespace App\Livewire;

use App\Models\Store;
use Livewire\Component;

class StoreShow extends Component
{
    public function render()
    {
        $stores = Store::all();

        $stores = $stores->filter(function ($store) {
            return $store->rut != 77563123;
        });

        return view('livewire.store-show', compact('stores'));
    }
}
