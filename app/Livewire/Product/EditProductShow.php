<?php

namespace App\Livewire\product;

use App\Jobs\SendProductUpdateToMobile;
use App\Livewire\Product\ProductsShow;
use App\Models\Product;
use App\Models\ProductImages;
use GuzzleHttp\Client;
use Livewire\Component;

class EditProductShow extends Component
{
    public $selectSubStoreProduct;
    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $images;
    public $newImages;
    public $deleteImages;

    public $disabledButton = false; // Controls button state

    // Event listeners for Livewire components
    protected $listeners = ['render', 'addNewImage'];

    /**
     * Validation rules for product creation.
     *
     * @return void
     */
    protected function rules()
    {
        return [
            'name' => 'required|min:3|regex:/^[a-zA-Z0-9\s\-_]+$/',
            'description' => 'required|max:255',
            'price' => 'required|regex:/^[1-9]\d*$/',
            'stock' => 'required|regex:/^[1-9]\d*$/',
        ];
    }

    /**
     * HTTP client for making asynchronous requests.
     *
     * @var Client
     */
    private $httpClient;

    /**
     * Initialize the component.
     */
    public function __construct()
    {
        $this->httpClient = new Client();
    }

    public function returnInventory()
    {
        $this->redirect('/inventory');
    }

    public function save()
    {
        $photos_paths = [];

        $this->validate($this->rules());

        $this->disabledButton = true;

        $avaliableImages = $this->verifyImages();

        if ($avaliableImages !== 0 && $this->newImages) {
            $photos_paths = $this->addImagesToProduct($avaliableImages);
        } else {
            $photos_paths = $this->obtainImages($this->selectSubStoreProduct->productDates);
        }

        // Search the product
        $this->selectSubStoreProduct->stock = $this->stock;
        $this->selectSubStoreProduct->price = $this->price;
        $this->selectSubStoreProduct->save();

        $updateProduct = $this->selectSubStoreProduct->productDates;
        $updateProduct->name = $this->name;
        $updateProduct->description = $this->description;
        $updateProduct->save();

        // dd($updateProduct, $this->selectSubStoreProduct, $photos_paths);
        // Send product to mobile app
        SendProductUpdateToMobile::dispatch($updateProduct, $this->selectSubStoreProduct, $photos_paths);

        $this->dispatch('render')->to(ProductsShow::class);
        toastr()->success('El producto fue actualizado con éxito', 'Producto actualizado!');
        $this->returnInventory();
    }

    /**
     * Verify if the images are complete.
     */
    private function verifyImages()
    {
        $nowImages = count($this->images);
        $maxImages = 5;

        if ($nowImages === $maxImages) {
            // Delete server images
            $this->deleteNewImagesServer();
        } elseif (count($this->deleteImages) > 0) {
            // Delete database images
            $this->deleteNewImagesServer(); // PENDIENTE ELIMINAR DEL SERVIDOR LAS IMAGENES ELIMINADAS
            $this->deleteNewImagesDatabases();
        }
        // Calculate avaliable images
        $avaliableImages = $maxImages - $nowImages;

        return $avaliableImages;
    }

    /**
     * Add images to the created product.
     */
    private function addImagesToProduct($avaliableImages)
    {
        for ($i = 0; $i < $avaliableImages; ++$i) {
            $image = $this->newImages[$i];
            $product = $this->selectSubStoreProduct->productDates;
            $path = 'products/'.$image['path'];

            // Iterates over the images array and creates a ProductImages record for each image.
            ProductImages::create([
                'name' => $image['name'],
                'path' => $path,
                'extension' => $image['extension'],
                'size' => $image['size'],
                'product_id' => $product->id,
            ]);
        }

        // Obtains the paths of the images associated with the product.
        $productImages = $product->productImages()->get();

        // Prepare Paths for Mobile App
        $paths = $productImages->pluck('path')->map(function ($path) {
            return config('app.aws_url').$path;
        })->toArray();

        return $paths;
    }

    private function obtainImages($updateProduct)
    {
        $product = Product::find($updateProduct->id);
        // Obtains the paths of the images associated with the product.
        $productImages = $product->productImages()->get();

        // Prepare Paths for Mobile App
        $paths = $productImages->pluck('path')->map(function ($path) {
            return config('app.aws_url').$path;
        })->toArray();

        return $paths;
    }

    /**
     * Delete new images in server.
     */
    private function deleteNewImagesServer()
    {
        foreach ($this->newImages as $image) {
            $this->dispatch('dropzone.delete', $image['path']);
        }
    }

    private function deleteNewImagesDatabases()
    {
        $numericIds = array_map('intval', $this->deleteImages);
        foreach ($this->deleteImages as $image) {
            ProductImages::destroy($numericIds);
        }
    }

    /**
     * Undocumented function.
     */
    public function replaceValues()
    {
        $selectProduct = $this->selectSubStoreProduct->productDates;

        $this->name = $selectProduct->name;
        $this->description = $selectProduct->description;
        $this->price = $this->selectSubStoreProduct->price;
        $this->stock = $this->selectSubStoreProduct->stock;

        $arrayImages = $this->formattedArrayImages($selectProduct->productImages);
        $this->images = $arrayImages;
    }

    public function addNewImage($imageInfo)
    {
        $this->newImages[] = $imageInfo;
        $this->skipRender();
    }

    public function deleteImage($selectedImage)
    {
        $this->deleteImages[] = $selectedImage;
        $this->images = array_filter($this->images, function ($image) use ($selectedImage) {
            return $image['id'] != $selectedImage;
        });
    }

    public function formattedArrayImages($images)
    {
        $arrayImages = [];

        foreach ($images as $image) {
            $formattedPath = str_replace('products/', '', $image->path);
            $arrayImages[] = [
                'id' => $image->id,
                'name' => $image->name,
                'originalPath' => $image->path,
                'path' => $formattedPath,
                'extension' => $image->extension,
                'size' => $image->size,
            ];
        }

        return $arrayImages;
    }

    public function mount($selectSubStoreProduct)
    {
        $this->selectSubStoreProduct = $selectSubStoreProduct;
        $this->replaceValues();
    }

    public function render()
    {
        return view('livewire.product.edit-product-show');
    }
}
