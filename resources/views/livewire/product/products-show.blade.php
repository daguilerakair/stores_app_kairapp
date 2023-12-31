<div>
{{-- {{ $subStoreProducts }} --}}
    <div>
        <label for="subStores" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Sucursal</label>
        <select id="subStores" wire:model='selectedOption' wire:change='handleSelectChange'
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @foreach ( $subStores as $subStore )
            <option value="{{ $subStore->id }}">{{ $subStore->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-row justify-center sm:justify-end">
        <div class="flex justify-end my-4">
            <a href="{{ route('category.create')}}"
                class="text-white bg-pink-custom-600 hover:bg-pink-custom-850 transition-all focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                Agregar categoría
            </a>
        </div>
        <div class="flex justify-end my-4">
            <a href="{{ route('product.create',['subStore' => $selectedOption])}}"
                class="text-white  bg-pink-custom-600 hover:bg-pink-custom-850 transition-all focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                Agregar producto
            </a>
        </div>
    </div>

    @if ($subStoreProducts && $subStoreProducts->count())
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Imagen
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cantidad disponible
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Precio
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Categoría
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subStoreProducts as $subStoreProduct)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="w-32 px-6 py-4 font-semibold text-gray-900">
                                <img src="{{ config('app.aws_url') . $subStoreProduct->productDates->productImages->first()->path }}"
                                    alt="product-img-{{ $subStoreProduct->productDates->productImages->first()->id }}">
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $subStoreProduct->productDates->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $subStoreProduct->stock }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                ${{ number_format($subStoreProduct->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{$subStoreProduct->categoryDates->category->name  }}
                            </td>
                            @if ($subStoreProduct->status)
                            <td class="px-6 py-4 font-semibold text-green-500">
                                HABILITADO
                            </td>
                            @else
                            <td class="px-6 py-4 font-semibold text-red-500">
                                DESHABILITADO
                            </td>
                            @endif
                            <td class="px-6 py-4">
                                <div class="flex gap-4">
                                    <div class="flex flex-col items-center my-auto">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input wire:click="receiveUpdates({{ $id = $subStoreProduct->id }})" type="checkbox" value="" class="sr-only peer" @if($subStoreProduct->status) checked @endif>
                                            <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                        </label>
                                        <p class="font-semibold text-xs">Estado</p>
                                    </div>

                                    <a href="{{ route('product.edit', ['id' => $subStoreProduct->id]) }}"
                                        class="flex flex-col items-center my-auto">
                                        <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path
                                                d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                            <path
                                                d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                        </svg>
                                        <p class="font-semibold text-xs">Editar</p>
                                    </a>

                                    {{-- {{ $currentStoreProduct }} --}}
                                    <button wire:click="$dispatch('deleteProduct', '{{{ $subStoreProduct->id }}}')"
                                        type="button" class="flex flex-col items-center my-auto">
                                        <svg class="w-5 h-5 text-red-500 hover:text-red-700 transition-all"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 18 20">
                                            <path
                                                d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                                        </svg>
                                        <p class="font-semibold text-xs">Eliminar</p>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="my-4">
                {{ $storeProducts->links() }}
            </div> --}}
        </div>
    @else
        <p class="font-semibold text-black text-xl text-center">No hay registros en el sistema</p>
    @endif
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('deleteProduct', (product) => {
                console.log(product);
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
                        @this.dispatch('delete', {
                           id: product
                        });
                        Swal.fire(
                            'Producto eliminado!',
                            'El producto ha sido eliminado con éxito.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>
@endpush
