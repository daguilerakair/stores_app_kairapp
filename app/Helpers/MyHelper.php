<?php

use App\Models\Role;
use App\Models\Store;
use App\Models\SubStore;

function makeMessages()
{
    $messages = [
        'name.required' => 'El campo nombre es requerido.',
        'email.required' => 'El campo correo electrónico es requerido.',
        'password.required' => 'El campo contraaseña es requerido.',
    ];

    return $messages;
}

function searchStore($store_rut)
{
    return Store::find($store_rut);
}

function searchSubStore($subStore_id)
{
    return SubStore::find($subStore_id);
}

function searchRole($role_id)
{
    return Role::find($role_id);
}
