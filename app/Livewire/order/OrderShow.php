<?php

namespace App\Livewire\order;

use App\Models\StoreOrder;
use Livewire\Component;

class OrderShow extends Component
{
    // Event listeners
    protected $listeners = ['render', 'editOrder'];

    public function editOrder($id)
    {
        // toastr()->success('La tienda fue creada con éxito', 'Tienda creada!');
        dd($id);
    }

    public function render()
    {
        $store_orders = StoreOrder::all();

        return view('livewire.order.order-show', ['storeOrders' => $store_orders]);
    }
}
