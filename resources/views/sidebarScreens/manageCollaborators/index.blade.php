<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administrar colaboradores') }}
        </h2>
    </x-slot>

    <div class="mb-2 p-6 bg-gray-custom-600">
        <h1 class="font-bold text-white text-2xl sm:text-3xl">Administrar colaboradores - {{ session('store')->fantasyName }}</h1>
        <h3 class="font-bold text-white text-lg sm:text-xl">{{ auth()->user()->name }} - {{ session('role')->name }}  </h3>
    </div>

    <div class="h-full p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            @livewire('collaborator.collaborator-show')
    </div>
</x-app-layout>
