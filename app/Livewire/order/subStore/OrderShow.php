<?php

namespace App\Livewire\Order\SubStore;

use App\Models\StoreOrder;
use Livewire\Component;

class OrderShow extends Component
{
    public function render()
    {
        $orders = StoreOrder::where('sub_store_id', session('selectedSubStore')->id)->get();

        return view('livewire.order.sub-store.order-show', ['orders' => $orders]);
    }
}
