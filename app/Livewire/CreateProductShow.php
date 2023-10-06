<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\StoreProduct;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProductShow extends Component
{
    use WithFileUploads;

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

        // Creamos el producto
        $product = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'pathImage' => 'https://firebasestorage.googleapis.com/v0/b/kairapp-dev.appspot.com/o/kairapp.png?alt=media&token=b974384b-e2a8-4316-b67b-b19c3832b426&_gl=1*sog09x*_ga*MTQ3MDUwODk1OS4xNjkxNjM5MDcw*_ga_CW55HF8NVT*MTY5NjQwNjE2Ni43Mi4xLjE2OTY0MDYyODguNjAuMC4w',
            'productMobileId' => null,
        ]);

        // Conectamos el producto con la tienda
        $store = session('store');
        StoreProduct::create([
            'price' => $this->price,
            'stock' => $this->stock,
            'status' => true,
            'delete' => false,
            'storeMobileId' => null,
            'store_rut' => $store->rut,
            'product_id' => $product->id,
        ]);

        $this->dispatch('render')->to(ProductsShow::class);
        toastr()->success('El producto fue creado con éxito', 'Producto creado!');
        $this->returnInventory();
    }

    public function render()
    {
        return view('livewire.create-product-show');
    }
}
