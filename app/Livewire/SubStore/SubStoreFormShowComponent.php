<?php

namespace App\Livewire\subStore;

use App\Jobs\SendStoreToMobile;
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

    public $disabledButton = false; // Controls button state

    public function addSubStore()
    {
        // dd($this->selectedStore);
        // Validate information related to the substore
        $this->validate($this->rules());
        $this->disabledButton = true;

        // Create the substore
        $subStore = $this->createSubStore();

        // Send the substore to the mobile app
        SendStoreToMobile::dispatch($this->selectedStore, $subStore);

        $this->dispatch('render')->to(SubstoreShowComponent::class);
        toastr()->success('La sucursal fue creada con éxito', 'Sucursal creada!');
        $this->returnStoresManagement();
    }

    protected function rules()
    {
        return [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'commission' => 'required',
            'phone' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ];
    }

    private function createSubStore()
    {
        // Creates a new subStore record in the database with the provided details.
        $subStore = SubStore::create([
            'name' => $this->name,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'commission' => $this->commission,
            'phone' => $this->phone,
            'store_rut' => $this->selectedStore->rut,
        ]);

        return $subStore;
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
