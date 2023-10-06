<?php

namespace App\Livewire;

use App\Models\UserStore;
use Livewire\Component;

class CollaboratorShow extends Component
{
    protected $listeners = ['render', 'delete'];

    public function receiveUpdates($id)
    {
        $userStore = UserStore::findOrFail($id);

        if ($userStore) {
            // Cambia el estado al opuesto
            $userStore->status = !$userStore->status;
            // Guarda los cambios en la base de datos
            $userStore->save();
        }
    }

    public function delete($id)
    {
        $userStore = UserStore::findOrFail($id);

        if ($userStore) {
            // Cambia el estado al opuesto
            $userStore->delete = !$userStore->delete;
            $userStore->status = false;
            // Guarda los cambios en la base de datos
            $userStore->save();
        }
    }

    public function render()
    {
        $storeCollaborators = session('store')->userStore()->get();

        $storeCollaborators = $storeCollaborators->filter(function ($storeProduct) {
            return $storeProduct->roleUser->name != 'Administrador' && $storeProduct->delete == false;
        });

        return view('livewire.collaborator-show', compact('storeCollaborators'));
    }
}
