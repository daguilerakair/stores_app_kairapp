<?php

namespace App\Livewire\Order\store;

use App\Models\StoreOrder;
use Livewire\Component;

class OrderShow extends Component
{
    public $subStores = [];
    public $selectedOption;

    public $selectedOptionController;

    public $subStoreOrders = [];

    public function handleSelectChange()
    {
        $findSubStoreOrders = StoreOrder::find($this->selectedOption);

        // asignamos los productos segun la sucursal seleccionada
        $this->subStoreOrders = $findSubStoreOrders;

        // $this->dispatch('render', selectedOption: $this->selectedOption)->to(ProductsShow::class);
        return redirect()->route('orders-selected.index', ['id' => $this->selectedOption]);
    }

    public function mount()
    {
        $store = session('store');
        $roleAdmin = session('role');
        $roleAdmin = session('role');
        if ($roleAdmin->id === 2) {
            $array = $store->subStores()->get();
            $this->subStores = $array;
            $this->selectedOption = session('selectedSubStore')->id;
        }
    }

    public function render()
    {
        if ($this->selectedOptionController === 0) {
            // Se obtiene la informacion de la tienda seleccionada
            $orders = StoreOrder::where('sub_store_id', $this->selectedOption)->get();
            $this->subStoreOrders = $orders;
        } else {
            $orders = StoreOrder::where('sub_store_id', $this->selectedOptionController)->get();
            $this->subStoreOrders = $orders;
            $this->selectedOption = $this->selectedOptionController;
            // dd($this->subStoreOrders);
        }

        return view('livewire.order.store.order-show');
    }
}
