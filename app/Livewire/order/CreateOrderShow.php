<?php

namespace App\Livewire\order;

use App\Models\Store;
use App\Models\StoreOrder;
use App\Models\SubStore;
use Livewire\Component;

class CreateOrderShow extends Component
{
    // Atributes order
    public $orderMobileId;
    public $total;
    public $date;
    public $quantity;
    public $price;
    public $product;

    public $searchRut;
    public $store;
    public $subStore;
    public $subStores = [];

    // Products to selected subStore;
    public $productsSubstore = [];

    // Fields products to order
    public $products = [];

    protected $rules = [
        'orderMobileId' => 'required',
        'total' => 'required',
        'date' => 'required|date',
        'store' => 'required',
        'subStore' => 'required',
        'products.*.quantity' => 'required|numeric|min:1',
        'products.*.buyPrice' => 'required|numeric|min:1',
        'products.*.product' => 'required',
    ];

    public function handleSearch()
    {
        dd($this->searchRut);
    }

    public function changedSelectStore()
    {
        $selectedStoreRUT = $this->store;
        $selectedStore = Store::find($selectedStoreRUT);

        if ($selectedStore) {
            $this->subStores = [];
            $subStoresORM = $selectedStore->subStores;
            $subStores = [];

            foreach ($subStoresORM as $subStore) {
                $subStore_id = $subStore->id;
                $subStore_name = $subStore->name;
                $subStore_mobile_id = $subStore->subStoreMobileId;

                $subStores[] = [
                    'subStore_id' => $subStore_id,
                    'name' => $subStore_name,
                    'subStore_mobile_id' => $subStore_mobile_id,
                ];
            }

            $this->subStores = $subStores;
        } else {
            $this->subStores = [];
        }
    }

    public function changedSelectSubStore()
    {
        // dd($this->subStore);
        $selectedSubStoreId = $this->subStore;
        $selectedSubStore = SubStore::find($selectedSubStoreId);

        if ($selectedSubStore) {
            $this->productsSubstore = [];
            $subStoreProductsORM = $selectedSubStore->productStore;
            $products = [];

            foreach ($subStoreProductsORM as $subStoreProduct) {
                $subStoreProduct_id = $subStoreProduct->id;
                $product_name = $subStoreProduct->productDates->name;
                $productMobileId = $subStoreProduct->productDates->productMobileId;

                $products[] = [
                    'subStoreProduct_id' => $subStoreProduct_id,
                    'name' => $product_name,
                    'subStoreProductMobileId' => $productMobileId,
                ];
            }

            $this->productsSubstore = $products;
        } else {
            $this->productsSubstore = [];
        }
    }

    public function save()
    {
        $this->validate();
        dd($this->products);

        // Create Store Order
        // $storeOrder = StoreOrder::create([
        //     'subTotal' =>,
        //     'date' =>,
        //     'orderMobile_id' =>,
        //     'storeMobileId' =>,
        //     'subStore_id' =>,
        // ]);

        // Create Store Product Orders
    }

    public function addShield()
    {
        $newKey = uniqid();
        $newShield = [
            'key' => $newKey,
            'quantity' => '',
            'buyPrice' => '',
            'note' => '',
            'product' => '',
        ];
        $this->products[$newKey] = $newShield;
    }

    public function removeShield($key)
    {
        $nowCount = count($this->products);
        if ($nowCount === 1) {
            session()->flash('ProductMessage', 'El pedido debe poseer al menos un producto.');
        } else {
            unset($this->products[$key]);
            $auxProducts = $this->products;
            $this->reset('products');
            $this->products = $auxProducts;
        }
    }

    public function mount()
    {
        $newKey = uniqid();
        $newShield = [
            'key' => $newKey,
            'quantity' => '',
            'buyPrice' => '',
            'note' => '',
        ];
        $this->products[$newKey] = $newShield;
    }

    public function render()
    {
        $store = Store::all()->where('rut', '!=', 77731223);

        return view('livewire.order.create-order-show', ['stores' => $store]);
    }
}
