<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de pedidos') }}
        </h2>
    </x-slot>

    <div class="mb-2 p-6 bg-gray-custom-600">
        <h1 class="font-bold text-white text-2xl sm:text-3xl">Gestión de pedidos - {{ session('store')->fantasyName }}</h1>
    </div>

    <div class="h-full p-4 ">
            @livewire('order.sub-store.order-show')
    </div>
</x-app-layout>
