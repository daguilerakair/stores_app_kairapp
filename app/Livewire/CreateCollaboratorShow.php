<?php

namespace App\Livewire;

use App\Models\Role;
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

    protected $rules = [
        'name' => 'required|regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/u',
        'email' => 'required|email',
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
                toastr()->error('El colaborador ya se encuentra asociado a la tienda', 'Colaborador no agregado!');
                $this->returnCreateCollaborator();
            } else {
                // Obtenemos el rol de colaborador
                $role = Role::where('name', '=', 'Colaborador')->first();

                // Obtenemos la tienda del administrador autenticado
                $store = session('store');

                UserStore::create([
                    'user_id' => $searchUser->id,
                    'store_rut' => $store->rut,
                    'role_id' => $role->id,
                    'status' => true,
                    'delete' => false,
                ]);

                Notification::route('slack', config('services.slack.notifications.slack_created_contributor'))
                            ->notify(new CreatedContributor());

                $this->dispatch('render')->to(CreateCollaboratorShow::class);
                toastr()->success('El colaborador fue agregado con éxito', 'Colaborador agregado!');
                $this->returnCollaborators();
            }
        } else {
            // Generar la contraseña del usuario
            $password = Str::random(8);
            // Creamos el usuario
            $collaborator = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($password),
            ]);

            // Obtenemos el rol de colaborador
            $role = Role::where('name', '=', 'Colaborador')->first();

            // Obtenemos la tienda del administrador autenticado
            $store = session('store');

            UserStore::create([
                'user_id' => $collaborator->id,
                'store_rut' => $store->rut,
                'role_id' => $role->id,
                'status' => true,
                'delete' => false,
            ]);

            Notification::route('slack', config('services.slack.notifications.slack_created_contributor'))
                        ->notify(new CreatedContributor());

            // Almacenar la variable en la sesión flash
            session()->flash('password', $password);

            $this->dispatch('render')->to(CreateCollaboratorShow::class);
            $this->returnCollaborators();
        }
    }

    public function render()
    {
        return view('livewire.create-collaborator-show');
    }
}
