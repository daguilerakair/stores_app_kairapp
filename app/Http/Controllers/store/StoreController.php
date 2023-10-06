<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Store;
use App\Models\User;
use App\Models\UserStore;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $userStore = UserStore::find($id);

        if ($userStore) {
            $store = Store::find($userStore->store_rut);
            $user = User::find($userStore->user_id);

            if (auth()->user()->id === $user->id) {
                $role = Role::find($userStore->role_id);

                // Guardar los datos en la sesión
                session(['store' => $store, 'role' => $role, 'user' => $user]);
                // Actualizar la seleccion del usuario a true
                session()->put(['selectedStore' => true]);

                return redirect()->route('dashboard');
            }
        }

        return redirect()->route('stores');
    }

    public function createStore()
    {
        return view('sidebarScreens.storesManagement.store.create');
    }
}
