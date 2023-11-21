<?php

namespace App\Livewire\order;

use App\Models\StoreOrder;
use Livewire\Component;

class OrderShow extends Component
{
    public function render()
    {
        $store_orders = StoreOrder::all();

        return view('livewire.order.order-show', ['storeOrders' => $store_orders]);
    }
}
