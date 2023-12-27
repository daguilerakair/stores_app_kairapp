<?php

namespace App\Livewire\product;

use App\Livewire\Product\ProductsShow;
use Livewire\Component;

class EditProductShow extends Component
{
    public $selectSubStoreProduct;
    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;

    protected $rules = [
        'name' => 'required|min:3|regex:/^[a-zA-Z0-9\s\-_]+$/',
        'description' => 'required|max:255',
        'price' => 'required|regex:/^[1-9]\d*$/',
        'stock' => 'required|regex:/^[1-9]\d*$/',
    ];

    public function returnInventory()
    {
        $this->redirect('/inventory');
    }

    public function save()
    {
        $this->validate();

        // Buscamos el producto
        $this->selectSubStoreProduct->stock = $this->stock;
        $this->selectSubStoreProduct->price = $this->price;
        $this->selectSubStoreProduct->save();

        $updateProduct = $this->selectSubStoreProduct->productDates;
        $updateProduct->name = $this->name;
        $updateProduct->description = $this->description;
        $updateProduct->save();

        // Conectamos el producto con la tienda
        $store = session('store');

        $this->dispatch('render')->to(ProductsShow::class);
        toastr()->success('El producto fue actualizado con éxito', 'Producto actualizado!');
        $this->returnInventory();
    }

    public function replaceValues()
    {
        $selectProduct = $this->selectSubStoreProduct->productDates;

        $this->name = $selectProduct->name;
        $this->description = $selectProduct->description;
        $this->price = $this->selectSubStoreProduct->price;
        $this->stock = $this->selectSubStoreProduct->stock;
    }

    public function mount($selectSubStoreProduct)
    {
        $this->selectSubStoreProduct = $selectSubStoreProduct;
    }

    public function render()
    {
        $this->replaceValues();

        return view('livewire.product.edit-product-show');
    }
}
