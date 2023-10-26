<?php

namespace App\Livewire;

use App\Models\Store;
use App\Models\User;
use App\Models\UserStore;
use Freshwork\ChileanBundle\Facades\Rut;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateStore extends Component
{
    // Store Fields
    public $rut;
    public $checkDigit;
    public $name;
    public $address;

    // Store Administrator Fields
    public $nameAdmin;
    public $email;

    // Validation rsules
    protected $rules = [
        'rut' => 'required|regex:/^[0-9]+$/',
        'checkDigit' => 'required|max:1|regex:/^[1-9K]+$/i',
        'name' => 'required|min:3|regex:/^[a-zA-Z0-9\s\-_]+$/',
        'address' => 'required',
        'nameAdmin' => 'required|regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/u',
        'email' => 'required|email',
    ];

    /**
     * Redirect to the Stores Management page.
     */
    public function returnStoresManagement()
    {
        $this->redirect('/stores/management');
    }

    /**
     * Redirect to the Create Store page.
     */
    public function returnCreateStore()
    {
        $this->redirect('/store/create');
    }

    /**
     * Save store and administrator data.
     */
    public function save()
    {
        $this->validate();

        $completeRut = $this->rut.'-'.$this->checkDigit;
        $validateRut = Rut::parse($completeRut)->validate();
        if (!$validateRut) {
            session()->flash('message', 'El RUT ingresado no existe.');
        } else {
            // Check if the store exists
            $searchStore = Store::find($this->rut);
            if (!$searchStore) {
                // Create a store
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

                // Assign the administrator to the created store
                // Check if the email is in the system
                $searchUser = User::where('email', $this->email)->first();
                if ($searchUser) {
                    // Assign the administrator to the store
                    UserStore::create([
                        'user_id' => $searchUser->id,
                        'store_rut' => $newStore->rut,
                        'role_id' => 1,
                        'status' => true,
                        'delete' => false,
                    ]);
                } else {
                    // Generate the user's password
                    $password = Str::random(8);
                    // Create the user
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

                    // Store the variable in the flash session
                    session()->flash('password', $password);
                    $this->dispatch('render')->to(CreateStore::class);
                    $this->returnStoresManagement();
                }
            } else {
                toastr()->error('La tienda ya se encuentra agregada en el sistema', 'Tienda no agregada!');
                $this->returnCreateStore();
            }
        }
    }

    /**
     * Render the Livewire component.
     */
    public function render()
    {
        return view('livewire.create-store');
    }
}
