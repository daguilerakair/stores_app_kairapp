<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestor de Inventario') }}
        </h2>
    </x-slot>

    <div class="mb-2 p-6 bg-gray-custom-600">
        <h1 class="font-bold text-white text-2xl sm:text-3xl">Gestor de Inventario - {{ session('store')->fantasyName }}</h1>
        <h3 class="font-bold text-white text-lg sm:text-xl">{{ auth()->user()->name }} - {{ session('role')->name }}  </h3>
    </div>

    <div class="h-full p-4 ">
        @livewire('category.create-category-show-component')
    </div>
</x-app-layout>
