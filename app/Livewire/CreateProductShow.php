<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\StoreProduct;
use App\Notifications\CreatedProduct;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProductShow extends Component
{
    use WithFileUploads;

    // Atributes product
    public $name;
    public $description;
    public $price;
    public $image;
    public $stock;
    public $category;

    public $disabledButton = false;

    protected $rules = [
        'name' => 'required|min:3|regex:/^[a-zA-Z0-9\s\-_]+$/',
        'description' => 'required|max:255',
        'price' => 'required|regex:/^[1-9]\d*$/',
        'stock' => 'required|regex:/^[1-9]\d*$/',
        'image' => 'max:2048|mimes:jpg,jpeg,png',
        'category' => 'required',
    ];

    public function returnInventory()
    {
        $this->redirect('/inventory');
    }

    public function save()
    {
        $this->validate();
        $existCategory = Category::find($this->category);

        if ($existCategory) {
            $this->disabledButton = true;
            $archiveNameTemp = $this->image->store('products');
            $content = Storage::disk('local')->get($archiveNameTemp);
            $replaceArchiveName = str_replace('products/', '', $archiveNameTemp);
            $response = Storage::disk('products')->put($replaceArchiveName, $content);

            if ($response) {
                $server_url = 'https://alphakairappbucket.s3.sa-east-1.amazonaws.com/';

                // Creamos el producto
                $product = Product::create([
                    'name' => $this->name,
                    'description' => $this->description,
                    'pathImage' => $server_url.$archiveNameTemp,
                    'productMobileId' => null,
                ]);

                // Conectar el producto con la tienda
                $store = session('store');
                $storeProduct = StoreProduct::create([
                    'price' => $this->price,
                    'stock' => $this->stock,
                    'status' => true,
                    'delete' => false,
                    'storeMobileId' => null,
                    'store_rut' => $store->rut,
                    'product_id' => $product->id,
                ]);

                // Conectar el producto a la categoria seleccionada
                ProductCategory::create([
                    'product_id' => $product->id,
                    'category_id' => $existCategory->id,
                ]);

                $information = [
                    'name' => $product->name,
                    'stock' => $storeProduct->stock,
                    'price' => $storeProduct->price,
                    'rut' => $storeProduct->store_rut,
                    'store_name' => $store->name,
                ];
                Notification::route('slack', config('services.slack.notifications.slack_created_product'))
                ->notify(new CreatedProduct($information));
                $this->dispatch('render')->to(ProductsShow::class);
                toastr()->success('El producto fue creado con éxito', 'Producto creado!');
                $this->returnInventory();
            }
        }
    }

    public function render()
    {
        // obtain categories system
        $categories = Category::orderBy('name', 'asc')->get();

        return view('livewire.create-product-show', compact('categories'));
    }
}
