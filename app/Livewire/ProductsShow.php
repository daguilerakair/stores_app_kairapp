<?php

namespace App\Livewire;

use App\Models\StoreProduct;
use Livewire\Component;

class ProductsShow extends Component
{
    public $editingProductID;
    public $editingProductPrice;
    public $editingProductStock;

    protected $listeners = ['render', 'delete'];

    public StoreProduct $currentStoreProduct;

    public function receiveUpdates($id)
    {
        $storeProduct = StoreProduct::findOrFail($id);

        if ($storeProduct) {
            // Cambia el estado al opuesto
            $storeProduct->status = !$storeProduct->status;
            // Guarda los cambios en la base de datos
            $storeProduct->save();
        }
    }

    public function edit($id)
    {
        dd($id);
        $selectProduct = StoreProduct::find($id)->first();
        $this->dispatch('create-product-show', selectProduct: $selectProduct);
    }

    public function delete($id)
    {
        $storeProduct = StoreProduct::findOrFail($id);

        if ($storeProduct) {
            // Cambia el estado al opuesto
            $storeProduct->delete = !$storeProduct->delete;
            // Guarda los cambios en la base de datos
            $storeProduct->save();
        }
    }

    // public function updatingSearch()
    // {
    //     $this->resetPage();
    // }

    public function render()
    {
        $storeProducts = session('store')->productStore()->get();

        $storeProductsFilter = $storeProducts->filter(function ($storeProduct) {
            return $storeProduct->delete == false;
        });

        return view('livewire.products-show', ['storeProductsFilter' => $storeProductsFilter]);
    }
}
