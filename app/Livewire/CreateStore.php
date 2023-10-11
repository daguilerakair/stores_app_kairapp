<?php

namespace App\Livewire;

use App\Models\Store;
use App\Models\User;
use App\Models\UserStore;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateStore extends Component
{
    // Campos Tienda
    public $rut;
    public $checkDigit;
    public $name;
    public $address;

    // Campos Administrador
    public $nameAdmin;
    public $email;

    protected $rules = [
        'rut' => 'required|regex:/^[1-9]+$/',
        'checkDigit' => 'required|max:1|regex:/^[1-9K]+$/i',
        'name' => 'required|min:3|regex:/^[a-zA-Z0-9\s\-_]+$/',
        'address' => 'required',
        'nameAdmin' => 'required|regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/u',
        'email' => 'required|email',
    ];

    public function returnStoresManagement()
    {
        $this->redirect('/stores/management');
    }

    public function returnCreateStore()
    {
        $this->redirect('/store/create');
    }

    public function save()
    {
        $this->validate();

        // Verificar si existe la tienda
        $searchStore = Store::find($this->rut);
        if (!$searchStore) {
            // Crear tienda
            $newStore = Store::create([
                'rut' => $this->rut,
                'checkDigit' => $this->checkDigit,
                'name' => $this->name,
                'address' => $this->address,
                'latitude' => '-35.4222',
                'length' => '-32.4222',
                'pathImage' => 'https://firebasestorage.googleapis.com/v0/b/kairapp-dev.appspot.com/o/kairapp.png?alt=media&token=b974384b-e2a8-4316-b67b-b19c3832b426&_gl=1*sog09x*_ga*MTQ3MDUwODk1OS4xNjkxNjM5MDcw*_ga_CW55HF8NVT*MTY5NjQwNjE2Ni43Mi4xLjE2OTY0MDYyODguNjAuMC4w',
                'storeMobileId' => null,
            ]);

            // Asignar el administrador a la tienda creada

            // Verificar que el email se encuentre en el sistema
            $searchUser = User::where('email', $this->email)->first();
            if ($searchUser) {
                // Asignar al administrador a la tienda
                UserStore::create([
                    'user_id' => $searchUser->id,
                    'store_rut' => $newStore->rut,
                    'role_id' => 1,
                    'status' => true,
                    'delete' => false,
                ]);
            } else {
                // Generar la contraseña del usuario
                $password = Str::random(8);
                // Crear al usuario
                $newUser = User::create([
                    'name' => $this->nameAdmin,
                    'email' => $this->email,
                    'password' => bcrypt($password),
                ]);

                UserStore::create([
                    'user_id' => $newUser->id,
                    'store_rut' => $newStore->rut,
                    'role_id' => 1,
                    'status' => true,
                    'delete' => false,
                ]);

                // Almacenar la variable en la sesión flash
                session()->flash('password', $password);
                $this->dispatch('render')->to(CreateStore::class);
                $this->returnStoresManagement();
            }
        } else {
            toastr()->error('La tienda ya se encuentra agregada en el sistema', 'Tienda no agregada!');
            $this->returnCreateStore();
        }

        // dd('libre');
    }

    public function render()
    {
        return view('livewire.create-store');
    }
}
