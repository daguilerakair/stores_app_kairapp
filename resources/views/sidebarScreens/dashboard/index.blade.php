<x-app-layout>
    @push('chart')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="mb-2 p-6 bg-gray-custom-600">
        <h1 class="font-bold text-white text-2xl sm:text-3xl">Dashboard - {{ session('store')->fantasyName }}</h1>
        <h3 class="font-bold text-white text-lg sm:text-xl">{{ auth()->user()->name }} - {{ session('role')->name }}
        </h3>
    </div>

    <div class="h-full p-4 ">
        @livewire('dashboard.dashboard-show-component')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</x-app-layout>
