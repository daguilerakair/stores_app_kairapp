<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administrar tiendas') }}
        </h2>
    </x-slot>
    <div class="my-2">
        <h1 class="font-bold text-3xl">Administrar tiendas - Crear Sucursal</h1>
    </div>
    <div class="h-full p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            @livewire('sub-store-form-show-component', ['selectedStore' => $selectedStore])
    </div>
</x-app-layout>
