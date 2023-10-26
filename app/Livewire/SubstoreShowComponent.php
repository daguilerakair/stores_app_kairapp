<?php

namespace App\Livewire;

use Livewire\Component;

class SubstoreShowComponent extends Component
{
    public $selectedStore;
    public $selectStoreSubStores;

    public function mount($selectStoreSubStores, $selectedStore)
    {
        $this->selectedStore = $selectedStore;
        $this->selectStoreSubStores = $selectStoreSubStores;
    }

    public function returnStores()
    {
        $this->redirect('/stores/management');
    }

    public function render()
    {
        return view('livewire.substore-show-component');
    }
}
