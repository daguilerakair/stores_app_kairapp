<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\SubStore;
use App\Models\SubStoreProduct;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendProductToMobile implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $product;
    protected $subStoreProduct;
    protected $subStore;
    protected $photos_paths;

    public function __construct(Product $product, SubStoreProduct $subStoreProduct, SubStore $subStore, array $photos_paths)
    {
        $this->product = $product;
        $this->subStoreProduct = $subStoreProduct;
        $this->subStore = $subStore;
        $this->photos_paths = $photos_paths;
    }

    public function handle()
    {
        $httpClient = new Client();
        $url = 'https://us-central1-kairapp-dev.cloudfunctions.net/sendOrderSGT/addProduct';

        try {
            $response = $httpClient->post($url, [
                'json' => [
                    'name' => $this->product->name,
                    'description' => $this->product->description,
                    'price' => $this->subStoreProduct->price,
                    'stock' => $this->subStoreProduct->stock,
                    'rating' => 0,
                    'is_high_value' => false,
                    'is_recommended' => false,
                    // Categories
                    'photo_urls' => $this->photos_paths,
                    'storeId' => $this->subStore->subStoreMobileId,
                ],
            ]);

            $responseBody = json_decode($response->getBody()->getContents(), true);
            $this->product->update(['productMobileId' => $responseBody['productId']]);
        } catch (GuzzleException $e) {
            // Manejo de errores
            logger()->error('Error en la solicitud Guzzle: '.$e->getMessage());
        }
    }
}