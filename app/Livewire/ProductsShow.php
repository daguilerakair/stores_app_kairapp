<?php

namespace App\Livewire;

use App\Models\StoreProduct;
use Livewire\Component;

class ProductsShow extends Component
{
    // Variables to hold data for editing a product
    public $editingProductID;
    public $editingProductPrice;
    public $editingProductStock;

    // Event listeners
    protected $listeners = ['render', 'delete'];

    // The current store product
    public StoreProduct $currentStoreProduct;

    /**
     * Receive updates for a store product's status.
     *
     * @param int $id the ID of the store product to update
     */
    public function receiveUpdates($id)
    {
        $storeProduct = StoreProduct::findOrFail($id);

        if ($storeProduct) {
            // Toggle the status
            $storeProduct->status = !$storeProduct->status;
            // Save the changes to the database
            $storeProduct->save();
        }
    }

    /**
     * Edit a store product.
     *
     * @param int $id the ID of the store product to edit
     */
    public function edit($id)
    {
        dd($id);
        $selectProduct = StoreProduct::find($id)->first();
        $this->dispatch('create-product-show', selectProduct: $selectProduct);
    }

    /**
     * Delete a store product.
     *
     * @param int $id the ID of the store product to delete
     */
    public function delete($id)
    {
        $storeProduct = StoreProduct::findOrFail($id);

        if ($storeProduct) {
            // Toggle the delete status
            $storeProduct->delete = !$storeProduct->delete;
            // Save the changes to the database
            $storeProduct->save();
        }
    }

    /**
     * Render the Livewire component.
     */
    public function render()
    {
        // Retrieve store products from the selected substore
        $storeProducts = session('selectedSubStore');

        if ($storeProducts) {
            $storeProducts = $storeProducts->productStore()->get();
            // Filter store products based on delete status
            $storeProductsFilter = $storeProducts->filter(function ($storeProduct) {
                return $storeProduct->delete == false;
            });

            return view('livewire.products-show', ['storeProductsFilter' => $storeProductsFilter]);
        } else {
            $storeProducts = null;

            return view('livewire.products-show', ['storeProductsFilter' => $storeProducts]);
        }
    }
}
