<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administrar pedidos') }}
        </h2>
    </x-slot>

    <div class="fixed z-10 sm:relative sm:z-0 mb-2 p-6 w-full bg-gray-custom-600">
        <h1 class="ml-8 sm:ml-0 font-bold text-white text-2xl sm:text-3xl">Administrar pedidos - Crear Pedido</h1>
    </div>

    <div class="h-full p-4 ">
        @livewire('order.create-order-show')
    </div>
</x-app-layout>
