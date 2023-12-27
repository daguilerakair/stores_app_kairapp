<?php

namespace App\Livewire\subStore;

use App\Livewire\SubStore\SubstoreShowComponent;
use App\Models\SubStore;
use Livewire\Component;

class SubStoreFormShowComponent extends Component
{
    // Tienda seleccionada
    public $selectedStore;

    public $name;
    public $address;
    public $commission;
    public $phone;
    public $latitude = 0.0;
    public $longitude = 0.0;

    public function addSubStore()
    {
        // Validamos la informacion ingresa relacionada al a substore
        $this->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'commission' => 'required',
            'phone' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // Crear sucursal
        SubStore::create([
            'name' => $this->name,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'commission' => $this->commission,
            'phone' => $this->phone,
            'store_rut' => $this->selectedStore->rut,
        ]);
        $this->dispatch('render')->to(SubstoreShowComponent::class);
        toastr()->success('La sucursal fue creada con éxito', 'Sucursal creada!');
        $this->returnStoresManagement();
    }

    public function returnStoresManagement()
    {
        $this->redirect('/stores/management');
    }

    public function mount($selectedStore)
    {
        $this->selectedStore = $selectedStore;
    }

    public function render()
    {
        return view('livewire.subStore.sub-store-form-show-component');
    }
}
