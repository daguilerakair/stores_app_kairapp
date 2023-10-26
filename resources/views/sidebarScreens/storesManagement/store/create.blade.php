<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> --}}
<link href="{{ asset('css/store-form.css') }}" rel="stylesheet" id="bootstrap-css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administrar tiendas') }}
        </h2>
    </x-slot>
    <div class="my-2">
        <h1 class="font-bold text-3xl">Administrar tiendas - Crear Tienda</h1>
    </div>
    <div class="h-full p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        {{-- @livewire('create-store') --}}
        {{-- <livewire:store.form.store-form-show-component> --}}
            @livewire('store-form-show-component')
    </div>
</x-app-layout>
