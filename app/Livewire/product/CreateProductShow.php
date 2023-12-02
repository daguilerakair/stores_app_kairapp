<?php

namespace App\Livewire\product;

use App\Livewire\Product\ProductsShow;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImages;
use App\Models\SubStoreProduct;
use App\Notifications\CreatedProduct;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProductShow extends Component
{
    use WithFileUploads;

    // Atributes product
    public $name;
    public $description;
    public $price;
    public $images = [];
    public $stock;
    public $category;
    public $subStore;

    public $disabledButton = false;

    public $characteristics = [];

    // Event listeners
    protected $listeners = ['render', 'addImage', 'removeImage'];

    protected $rules = [
        'name' => 'required|min:3|regex:/^[a-zA-Z0-9\s\-_]+$/',
        'description' => 'required|max:255',
        'price' => 'required|regex:/^[1-9]\d*$/',
        'stock' => 'required|regex:/^[1-9]\d*$/',
        'images' => 'required',
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

    public function removeImage($path)
    {
        $deleteImage = $path;
        $this->images = array_filter($this->images, function ($value) use ($deleteImage) {
            return $value !== $deleteImage;
        });
        $this->skipRender();
    }

    public function addImage($pathImage)
    {
        $this->images[] = $pathImage;
        $this->skipRender();
    }

    public function save()
    {
        $this->validate();

        $existCategory = Category::find($this->category);

        if ($existCategory) {
            $this->disabledButton = true;

            $store = session('store');

            // Creamos el producto
            $product = Product::create([
                'name' => $this->name,
                'description' => $this->description,
                'pathImage' => 'ssss',
                'price' => $this->price,
                'variablePrice' => false,
                'store_rut' => $store->rut,
            ]);

            // Agregar las imagenes al producto
            foreach ($this->images as $image) {
                ProductImages::create([
                    'path' => 'products/'.$image,
                    'product_id' => $product->id,
                ]);
            }

            // Crear el substoreProduct
            $subStoreProduct = SubStoreProduct::create([
                'price' => $this->price,
                'stock' => $this->stock,
                'status' => true,
                'delete' => false,
                'product_id' => $product->id,
                'sub_store_id' => $this->subStore,
            ]);

            // Conectar el producto a la categoria seleccionada
            ProductCategory::create([
                'product_id' => $product->id,
                'category_id' => $existCategory->id,
            ]);

            $information = [
                'name' => $product->name,
                'store_name' => $store->name,
                'stock' => $subStoreProduct->stock,
                'price' => $subStoreProduct->price,
                'rut' => $store->rut,
            ];
            Notification::route('slack', config('services.slack.notifications.slack_created_product'))
            ->notify(new CreatedProduct($information));
            $this->dispatch('render')->to(ProductsShow::class);
            toastr()->success('El producto fue creado con éxito', 'Producto creado!');
            $this->returnInventory();
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
