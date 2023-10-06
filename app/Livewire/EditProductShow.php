<?php

namespace App\Livewire;

use Livewire\Component;

class EditProductShow extends Component
{
    public $selectStoreProduct;
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
        // dd($this->id);
        $this->validate();

        // Buscamos el producto
        $this->selectStoreProduct->stock = $this->stock;
        $this->selectStoreProduct->price = $this->price;
        $this->selectStoreProduct->save();

        $updateProduct = $this->selectStoreProduct->productDates;
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
        $selectProduct = $this->selectStoreProduct->productDates;

        $this->name = $selectProduct->name;
        $this->description = $selectProduct->description;
        $this->price = $this->selectStoreProduct->price;
        $this->stock = $this->selectStoreProduct->stock;
    }

    public function mount($selectStoreProduct)
    {
        $this->selectStoreProduct = $selectStoreProduct;
    }

    public function render()
    {
        $this->replaceValues();

        return view('livewire.edit-product-show');
    }
}
