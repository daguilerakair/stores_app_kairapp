<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de tiendas') }}
        </h2>
    </x-slot>

    <div class="my-2">
        <h1 class="font-bold text-3xl">Gestión de tiendas</h1>
    </div>

    <div class="h-full p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            @livewire('store-show')
    </div>
</x-app-layout>
