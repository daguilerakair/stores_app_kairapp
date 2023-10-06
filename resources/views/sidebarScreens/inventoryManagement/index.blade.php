@include('layouts.navigation')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestor de Inventario') }}
        </h2>
    </x-slot>

    <div class="my-2">
        <h1 class="font-bold text-3xl">Gestor de Inventario - {{ session('store')->name }}</h1>
    </div>

    <div class="h-full p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <form>
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">
                <div id="my-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li class="active" data-target="#my-carousel" data-slide-to="0" aria-current="location"></li>
                        <li data-target="#my-carousel" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="" alt="">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Title</h5>
                                <p>Text</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="" alt="">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Title</h5>
                                <p>Text</p>
                            </div>
                        </div>
                    </div>
                </div>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search"
                    class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Buscar productos..." required>
                <button type="submit"
                    class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 transition-all dark:focus:ring-blue-800">
                    Buscar
                </button>
            </div>
        </form>

        <div class="flex justify-end">
            <button id="btn-navigate" type="button"
                class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                Agregar producto
            </button>
        </div>

        @if ($storeProducts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 py-2.5">
                @foreach ($storeProducts as $storeProduct)
                    <div
                        class="block max-w-sm p-2 bg-white border border-gray-200 rounded-lg shadow h dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex">
                            <img class="h-24 w-24 p-2" src="{{ $storeProduct->productDates->pathImage }}"
                                alt="product-img" />
                            <div>
                                @if ($storeProduct->status)
                                    <p class="mb-2 text-lg font-semibold text-green-500 dark:text-white uppercase">
                                        Habilitado
                                    </p>
                                @else
                                    <p class="mb-2 text-lg font-semibold text-red-500 dark:text-white uppercase">
                                        Deshabilitado
                                    </p>
                                @endif
                                <p class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $storeProduct->productDates->name }}
                                </p>
                                <p class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
                                    Cantidad disponible: {{ $storeProduct->stock }}
                                </p>
                                <p class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
                                    CLP {{ $storeProduct->price }}
                                </p>
                            </div>
                        </div>
                        {{-- Actions to product --}}
                        <div class=" bg-gray-100 flex justify-around py-1 rounded-sm">
                            <a href="#" class="flex flex-col items-center my-auto">
                                <svg class="w-5 h-5 text-red-500 hover:text-red-700 transition-all dark:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 18 20">
                                    <path
                                        d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                                </svg>
                                <p class="font-semibold text-xs">Eliminar</p>
                            </a>

                            <button type="button" class="flex flex-col items-center my-auto"
                                data-modal-toggle="defaultModal-{{ $storeProduct->id }}">
                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                    <path
                                        d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                    <path
                                        d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                </svg>
                                <p class="font-semibold text-xs">Editar</p>
                            </button>

                            <form class="my-auto formulario" method="GET"
                                action="{{ route('status.product', ['id' => $storeProduct->id]) }}">
                                <button data-name="{{ $storeProduct->status }}" type="submit"
                                    class="flex flex-col items-center show-alert">
                                    @if ($storeProduct->status)
                                        <svg class="w-5 h-5 text-green-500 hover:text-green-700 transition-all dark:text-white"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-red-500 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                                        </svg>
                                    @endif
                                    <p class="font-semibold text-xs">Estado</p>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Main modal -->
                    <div id="defaultModal-{{ $storeProduct->id }}" data-modal-backdrop="static" tabindex="-1"
                        aria-hidden="true"
                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Static modal
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="defaultModal-{{ $storeProduct->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-6 space-y-6">
                                    <p>{{ $storeProduct->productDates->name }}</p>
                                    <form novalidate>
                                        <div class="relative z-0 w-full mb-6 group">
                                            <input type="text" name="floating_name" id="floating_name"
                                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                placeholder=" " required />
                                            <label for="floating_name"
                                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                                Cantidad
                                            </label>
                                        </div>
                                        <div class="relative z-0 w-full mb-6 group">
                                            <input type="password" name="floating_description"
                                                id="floating_description"
                                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                placeholder=" " required />
                                            <label for="floating_description"
                                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                                Precio
                                            </label>
                                        </div>
                                        <div class="flex justify-center gap-4">
                                            <button type="submit"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                Actualizar producto
                                            </button>
                                            <button id="btn-return"
                                                data-modal-hide="defaultModal-{{ $storeProduct->id }}" type="button"
                                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                Cerrar
                                            </button>

                                        </div>
                                    </form>
                                </div>
                                <!-- Modal footer -->
                                {{-- <div
                                    class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="defaultModal-{{ $storeProduct->id }}" type="button"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                                        accept</button>
                                    <button data-modal-hide="defaultModal-{{ $storeProduct->id }}" type="button"
                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="font-semibold text-2xl text-center">No se encuentran productos en tu inventario</p>
        @endif
        <script>
            document.getElementById('btn-navigate').addEventListener('click', function() {
                window.location.href = "{{ route('product.create') }}"
            });
        </script>

        <script>
            const formularios = document.getElementsByClassName("formulario");

            for (const form of formularios) {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Estás seguro que quieres habilitar/deshabilitar este producto?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#4DD091',
                        cancelButtonColor: '#FF5C77',
                        confirmButtonText: 'Confirmar',
                        cancelButtonText: 'Cancelar',
                        allowOutsideClick: false,

                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'La acción se ha realizado con exito!',
                                showConfirmButton: false,
                                timer: 2000
                            });

                            setTimeout(() => {
                                form.submit();
                            }, 2000);

                        }
                    })
                })
            }
        </script>

        {{-- <script>
    const formularios = document.getElementsByClassName("formularioDelete");

    for (const form of formularios) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro que quieres eliminar este producto?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4DD091',
                cancelButtonColor: '#FF5C77',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                allowOutsideClick: false,

            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'La acción se ha realizado con exito!',
                        showConfirmButton: false,
                        timer: 1500,
                    })
                    form.submit();
                }
            })
        })
    }
</script> --}}
</x-app-layout>
