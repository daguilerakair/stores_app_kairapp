<div>
    @if (session()->has('password'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
        role="alert">
        <span class="font-medium">Administrador creado con éxito</span>
        Recuerde suministrar su contraseña al administrador creado.
        <button id="btn">
            Mostrar contraseña
        </button>
        <input type="hidden" id="password" name="password" value="{{ session('password') }}">
    </div>
    @endif

    <div class="flex justify-end my-4">
        <a href="{{ route('store.create') }}"
            class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
            Agregar tienda
        </a>
    </div>
    @if ($stores->count())
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            RUT
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Dirección
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cantidad de trabajadores
                        </th>
                        {{-- <th scope="col" class="px-6 py-3">
                            Accion
                        </th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stores as $store)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="w-32 p-4">
                                {{ $store->rut }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $store->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $store->address }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $store->user_store_count }}
                            </td>

                            {{-- <td class="px-6 py-4 font-semibold text-gray-900">
                                <div class="flex gap-4">
                                <div class="flex flex-col items-center my-auto">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input wire:click="receiveUpdates({{ $id = $store->id }})" type="checkbox" value="" class="sr-only peer" @if($store->status) checked @endif>
                                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    </label>
                                    <p class="font-semibold text-xs">Estado</p>
                                </div>
                                <button wire:click="$dispatch('deleteUser', '{{{ $store->id }}}')" type="button" class="flex flex-col items-center my-auto">
                                    <svg class="w-5 h-5 text-red-500 hover:text-red-700 transition-all"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 18 20">
                                        <path
                                            d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                                    </svg>
                                    <p class="font-semibold text-xs">Eliminar</p>
                                </button>
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="font-semibold text-black text-xl text-center">No hay tiedas que formen parte de la tienda</p>
    @endif
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const button = document.getElementById('btn');
        if(button){
            button.addEventListener('click', () => {
                const password = document.getElementById('password').value;
                console.log(password);
                Swal.fire({
                    title: 'Recuerda copiar la contraseña de tu administrador',
                    text: password,
                    icon: 'info',
                    confirmButtonColor: '#FF5C77',
                    confirmButtonText: 'Cancelar',
                })
            });
        }
    </script>
@endpush
