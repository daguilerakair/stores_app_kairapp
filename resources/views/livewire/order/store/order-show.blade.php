<div>
    <div class="my-8">
        <label for="subStores" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Filtrar por sucursal</label>
        <select id="subStores" wire:model='selectedOption' wire:change='handleSelectChange'
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @foreach ( $subStores as $subStore )
            <option value="{{ $subStore->id }}">{{ $subStore->name }}</option>
            @endforeach
        </select>
    </div>

    @if ($subStoreOrders && $subStoreOrders->count())
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Subtotal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre Sucursal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subStoreOrders as $order)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="w-32 px-6 py-4 font-semibold text-gray-900">
                                {{ number_format($order->subTotal, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ date('d/m/Y', strtotime($order->date)) }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $order->subStoreDates->name }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                <button wire:click="$dispatch('openModal', {component: 'order.detail-order', arguments: {order_id: {{ $order->id }}}})"
                                    class="flex flex-col sm:items-start items-center my-auto">
                                    <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                        <path
                                            d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-3 15H4.828a1 1 0 0 1 0-2h6.238a1 1 0 0 1 0 2Zm0-4H4.828a1 1 0 0 1 0-2h6.238a1 1 0 1 1 0 2Z" />
                                        <path
                                            d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                                    </svg>
                                    <p class="font-semibold text-xs">Ver detalle</p>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="font-semibold text-black text-xl text-center">No hay pedidos en el sistema</p>
    @endif
</div>

