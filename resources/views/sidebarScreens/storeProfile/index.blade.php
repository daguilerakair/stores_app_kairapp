<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perfil Tienda') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-gray-custom-600">
        <h1 class="font-bold text-white text-2xl sm:text-3xl">Perfil Tienda</h1>
    </div>

    <div class="h-full">
            @livewire('profile.store.store-show-component')
    </div>
</x-app-layout>
