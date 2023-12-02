<?php

namespace App\Livewire\store;

use App\Livewire\Store\StoreShow;
use App\Models\Role;
use App\Models\Store;
use App\Models\User;
use App\Models\UserStore;
use App\Notifications\CreatedStore;
use Freshwork\ChileanBundle\Facades\Rut;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Livewire\Component;

class StoreFormShowComponent extends Component
{
    // Store Fields
    public $rut;
    public $checkDigit;
    public $companyName;
    public $fantasyName;
    public $address;
    public $radioCheckedItinerant = 'Y';
    public $radioCheckedCustom = 'Y';

    // Store Administrator Fields
    public $nameAdmin;
    public $email;

    /**
     * Write code on Method.
     *
     * @return response()
     */
    public function render()
    {
        return view('livewire.store.store-form-show-component');
    }

    /**
     * Write code on Method.
     *
     * @return response()
     */
    public function addStore()
    {
        $this->validate([
        'rut' => 'required|regex:/^[0-9]+$/|unique:stores',
        'checkDigit' => 'required|max:1|regex:/^[1-9K]+$/i',
        'companyName' => 'required|min:3|regex:/^[a-zA-Z0-9\s\-_]+$/',
        'fantasyName' => 'required|min:3|regex:/^[a-zA-Z0-9\s\-_]+$/',
        'radioCheckedItinerant' => 'required',
        'radioCheckedCustom' => 'required',
        'nameAdmin' => 'required|regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/u',
        'email' => 'required|email',
        ]);

        $completeRut = $this->rut.'-'.$this->checkDigit;
        $validateRut = Rut::parse($completeRut)->validate();
        if (!$validateRut) {
            session()->flash('message', 'El RUT ingresado no existe.');
        } else {
            // Validar que la tienda no exista
            $existStore = Store::find($this->rut);
            if (!$existStore) {
                // Limpiar valores de los radio button
                $radioCheckedCustom = ($this->radioCheckedCustom === 'Y') ? true : false;
                $radioCheckedItinerant = ($this->radioCheckedItinerant === 'Y') ? true : false;

                // Crear Tienda
                $store = Store::create([
                    'rut' => $this->rut,
                    'checkDigit' => $this->checkDigit,
                    'companyName' => $this->companyName,
                    'fantasyName' => $this->fantasyName,
                    'itinerant' => $radioCheckedItinerant,
                    'custom' => $radioCheckedCustom,
                    'pathProfile' => 'https://alphakairappbucket.s3.sa-east-1.amazonaws.com/stores/profile/kairapp-isologo-negro-avatar-300px+(1).png',
                    'pathBackground' => 'https://alphakairappbucket.s3.sa-east-1.amazonaws.com/stores/background/kairapp-logo-horizontal-1000px.png',
                ]);

                // Validar si el usuario existe
                // Verificar que el email se encuentre en el sistema
                $searchUser = User::where('email', $this->email)->first();
                if ($searchUser) {
                    // Obtenemos el rol de colaborador
                    $role = Role::where('name', '=', 'Administrador Tienda')->first();

                    // Asignamos el rol directamente al usuario
                    UserStore::create([
                        'user_id' => $searchUser->id,
                        'store_rut' => $store->rut,
                        'role_id' => $role->id,
                        'admin' => true,
                        'status' => true,
                        'delete' => false,
                    ]);

                    $information = [
                        'rut' => $store->rut,
                        'companyName' => $store->companyName,
                        'fantasyName' => $store->fantasyName,
                        'nameAdmin' => $searchUser->name,
                        'emailAdmin' => $searchUser->email,
                    ];

                    Notification::route('slack', config('services.slack.notifications.slack_created_store'))
                    ->notify(new CreatedStore($information));
                    $this->dispatch('render')->to(StoreShow::class);
                    toastr()->success('La tienda fue creada con éxito', 'Tienda creada!');
                    $this->returnStoresManagement();
                } else {
                    // Generate the user's password
                    $password = Str::random(8);
                    // creamos al usuario.
                    $user = User::create([
                        'name' => $this->nameAdmin,
                        'email' => $this->email,
                        'password' => bcrypt($password),
                    ]);

                    // Obtenemos el rol de colaborador
                    $role = Role::where('name', '=', 'Administrador Tienda')->first();

                    // Asignamos el rol directamente al usuario
                    UserStore::create([
                        'user_id' => $user->id,
                        'store_rut' => $store->rut,
                        'role_id' => $role->id,
                        'admin' => true,
                        'status' => true,
                        'delete' => false,
                    ]);

                    $information = [
                        'rut' => $store->rut,
                        'companyName' => $store->companyName,
                        'fantasyName' => $store->fantasyName,
                        'nameAdmin' => $user->name,
                        'emailAdmin' => $user->email,
                    ];

                    // Store the variable in the flash session
                    session()->flash('password', $password);
                    Notification::route('slack', config('services.slack.notifications.slack_created_store'))
                    ->notify(new CreatedStore($information));
                    $this->dispatch('render')->to(StoreShow::class);
                    toastr()->success('La tienda fue creada con éxito', 'Tienda creada!');

                    // $this->returnStoresManagement();
                    return redirect()->to('subStore/create/%24'.$store->rut);
                }
            }
        }
    }

    public function returnStoresManagement()
    {
        $this->redirect('/stores/management');
    }
}
