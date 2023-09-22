<?php

namespace App\Http\Controllers\store;

use App\Models\Role;
use App\Models\User;
use App\Models\Store;
use App\Models\UserStore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $userStore = UserStore::find($id);
        $store = Store::find($userStore->store_rut);
        $user = User::find($userStore->user_id);

        if (auth()->user()->id === $user->id) {

            $role = Role::find($userStore->role_id);
            // Guardar los datos en la sesión
            session(['store' => $store, 'role' => $role, 'user' => $user]);
            return view('dashboard');
        } else {
            return view('user.stores', [
                'user' => auth()->user()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
    }
}
