<?php

namespace App\Livewire\product;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SubStoreProduct;
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
    public $subStore;

    public $disabledButton = false;
    public $selectedItems = [];

    public $characteristics = [];
    public $radioChecked = 'Y';

    protected $rules = [
        'name' => 'required|min:3|regex:/^[a-zA-Z0-9\s\-_]+$/',
        'description' => 'required|max:255',
        'price' => 'required|regex:/^[1-9]\d*$/',
        'stock' => 'required|regex:/^[1-9]\d*$/',
        'image' => 'max:2048|mimes:jpg,jpeg,png',
        'category' => 'required',
        'characteristics.*.value' => 'required',
    ];

    public function returnInventory()
    {
        $this->redirect('/inventory');
    }

    public function changedSelectCategory()
    {
        $category = Category::find($this->category);

        if ($category) {
            $this->characteristics = [];
            $characteristicsORM = $category->obtainCharacteristiCategories;

            $characteristics = [];
            foreach ($characteristicsORM as $characteristic) {
                $characteristic_category_id = $characteristic->id;
                $nameCharacteristic = $characteristic->getCharacteristic->name;
                $characteristic_id = $characteristic->characteristic_id;
                $category_id = $characteristic->category_id;

                $characteristics[] = [
                    'characteristic_category_id' => $characteristic_category_id,
                    'name' => $nameCharacteristic,
                    'characteristic_id' => $characteristic_id,
                    'category_id' => $category_id,
                    'value' => '',
                ];
            }

            $this->characteristics = $characteristics;
        } else {
            $this->characteristics = [];
        }
    }

    public function save()
    {
        $this->validate();

        dd($this->name, $this->characteristics);
        $existCategory = Category::find($this->category);

        if ($existCategory) {
            if ($this->radioChecked === 'Y') {
                $this->disabledButton = true;
                $archiveNameTemp = $this->image->store('products');
                // dd($archiveNameTemp);
                $content = Storage::disk('local')->get($archiveNameTemp);
                $replaceArchiveName = str_replace('products/', '', $archiveNameTemp);
                $response = Storage::disk('products')->put($replaceArchiveName, $content);

                if ($response) {
                    $server_url = 'https://alphakairappbucket.s3.sa-east-1.amazonaws.com/';
                    // Conectar el producto con la tienda
                    $store = session('store');

                    // Creamos el producto
                    $product = Product::create([
                        'name' => $this->name,
                        'description' => $this->description,
                        'pathImage' => $server_url.$archiveNameTemp,
                        'price' => $this->price,
                        'variablePrice' => false,
                        'store_rut' => $store->rut,
                    ]);

                    $subStores = $store->subStores()->get();

                    foreach ($subStores as $subStore) {
                        // Crear el substoreProduct
                        SubStoreProduct::create([
                            'price' => $this->price,
                            'stock' => $this->stock,
                            'status' => true,
                            'delete' => false,
                            'product_id' => $product->id,
                            'sub_store_id' => $subStore->id,
                        ]);
                    }

                    // Conectar el producto a la categoria seleccionada
                    ProductCategory::create([
                        'product_id' => $product->id,
                        'category_id' => $existCategory->id,
                    ]);

                    $information = [
                        'name' => $product->name,
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
    }

    public function render()
    {
        // obtain categories system
        $categories = Category::orderBy('name', 'asc')->get();

        // obtain substores to selected store.
        $store = session('store');
        $subStores = $store->subStores()->get();

        return view('livewire.product.create-product-show', compact('categories', 'subStores'));
    }
}
