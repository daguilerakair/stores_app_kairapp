<?php

namespace App\Livewire\collaborator;

use App\Models\Role;
use App\Models\Store;
use App\Models\User;
use App\Models\UserStore;
use App\Notifications\CreatedContributor;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateCollaboratorShow extends Component
{
    public $name;
    public $email;
    public $role;
    public $subStoreUser;

    protected $rules = [
        'name' => 'required|regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/u',
        'email' => 'required|email',
        'role' => 'required',
        'subStoreUser' => 'required',
    ];

    public function returnCollaborators()
    {
        $this->redirect('/collaborators');
    }

    public function returnCreateCollaborator()
    {
        $this->redirect('/collaborator/create');
    }

    public function save()
    {
        $this->validate();

        // Verificar que el email se encuentre en el sistema
        $searchUser = User::where('email', $this->email)->first();
        if ($searchUser) {
            // Obtener la tienda del administrador autenticado.
            $store = session('store');
            // Verificar si el usuario ya se encuentra asociado a la tienda.
            $userStore = $store->searchUserStore($searchUser->id);

            if ($userStore) {
                toastr()->error('El trabajador ya se encuentra asociado a la tienda', 'Colaborador no agregado!');
                $this->returnCreateCollaborator();
            } else {
                // Obtenemos el rol de colaborador
                $role = Role::where('name', '=', 'Colaborador')->first();

                $responseLink = $this->linkEmployeeToStore($this->role, $searchUser);

                // Obtenemos la informacion de la tienda, sucursal y rol de usuario de la respuesta.
                $store = $responseLink['store'];
                $subStore = $responseLink['subStore'];
                $role = $responseLink['role'];

                $this->notifySlack($userStore, $store, $role, $subStore);

                $this->dispatch('render')->to(CreateCollaboratorShow::class);
                toastr()->success('El trabajador fue agregado con éxito', 'Trabajador agregado!');
                $this->returnCollaborators();
            }
        } else {
            $response = $this->createEmployee();

            // Obtenemos la informacion del usuario de la respuesta.
            $user = $response['user'];
            $password = $response['password'];

            $responseLink = $this->linkEmployeeToStore($this->role, $user);

            // Obtenemos la informacion de la tienda, sucursal y rol de usuario de la respuesta.
            $store = $responseLink['store'];
            $subStore = $responseLink['subStore'];
            $role = $responseLink['role'];

            $this->notifySlack($user, $store, $role, $subStore);

            // Almacenar la variable en la sesión flash
            session()->flash('password', $password);
            $this->dispatch('render')->to(CreateCollaboratorShow::class);
            $this->returnCollaborators();
        }
    }

    public function verifyEmployeeStore()
    {
    }

    public function createEmployee()
    {
        // Generar la contraseña del usuario
        $password = Str::random(8);
        // Creamos el usuario
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($password),
        ]);

        $response = [
            'user' => $user,
            'password' => $password,
        ];

        return $response;
    }

    public function linkEmployeeToStore($role, $user)
    {
        // Role
        $role = Role::find($role)->first();
        // Obtenemos la tienda del administrador autenticado
        $store = session('store');

        $userStore = UserStore::create([
            'user_id' => $user->id,
            'store_rut' => $store->rut,
            'role_id' => $this->role,
            'subStore_id' => $this->subStoreUser,
            'admin' => false,
            'status' => true,
            'delete' => false,
        ]);

        $store = searchStore($userStore->store_rut);
        $subStore = searchSubStore($userStore->subStore_id);
        $role = searchRole($userStore->role_id);

        $response = [
            'store' => $store,
            'subStore' => $subStore,
            'role' => $role,
        ];

        return $response;
    }

    public function notifySlack($user, $store, $role, $subStore)
    {
        $information = [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $role->name,
            'store' => $store->fantasyName,
            'subStore' => $subStore->name,
        ];
        Notification::route('slack', config('services.slack.notifications.slack_created_contributor'))
                    ->notify(new CreatedContributor($information));
    }

    public function render()
    {
        // obtain roles system
        $roles = Role::where('name', '!=', 'Administrador Kairapp')->where('name', '!=', 'Administrador Tienda')->orderBy('name', 'asc')->get();

        $store = session('store');
        // obtain subStores to store
        $subStores = $store->subStores()->get();

        return view('livewire.collaborator.create-collaborator-show', compact('roles', 'subStores'));
    }
}
