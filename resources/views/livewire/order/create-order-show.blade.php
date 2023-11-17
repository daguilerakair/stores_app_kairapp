<div>
    <div class="bg-white p-4 mb-4 rounded-sm" wire:ignore.self>
        <h3 class="font-bold mb-4 text-xl uppercase text-black">Información general</h3>

        <div class="relative z-0 w-full mb-6 group">
            <label for="floating_order_mobile_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                ID Orden Móvil
            </label>
            <input wire:model="orderMobileId" type="text" name="floating_order_mobile_id" id="floating_order_mobile_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder=" " required />
            @error('orderMobileId')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <label for="floating_total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Total
            </label>
            <input wire:model="total" type="text" name="floating_total" id="floating_total"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder=" " required />
            @error('total')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <label for="floating_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Fecha
            </label>
            <input wire:model="date" type="date" name="repeat_password" id="floating_date"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" required />
            @error('date')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <label for="stores" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">
                Seleccione una tienda
            </label>
            <select wire:model="store" wire:change='changedSelectStore' id="stores"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" selected>--Seleccione--</option>
                @foreach ($stores as $store)
                    <option value="{{ $store->rut }}">{{ $store->fantasyName }}</option>
                @endforeach
            </select>
            @error('store')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <label for="subStores" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">
                Seleccione una sucursal
            </label>
            <select wire:model="subStore" wire:change='changedSelectSubStore' id="subStores"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" selected>--Seleccione--</option>
                @foreach ($subStores as $subStore)
                    <option value="{{ $subStore['subStore_id'] }}">{{ $subStore['subStore_mobile_id'] }} - {{ $subStore['name'] }}</option>
                @endforeach
            </select>
            @error('subStore')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <h3 class="font-bold mb-4 text-xl uppercase text-black">Detalle productos</h3>
        <hr class="h-px my-8 bg-black border-0">

        <div>
            @foreach ($products as $key => $product)
                <div wire:key="{{ $key }}">
                    <h2 class="font-bold mb-8 text-lg uppercase text-black">Producto {{ $loop->iteration }}</h2>

                    <div class="grid sm:grid-cols-2 sm:gap-4">
                        <div class="relative z-0 w-full mb-6 group">
                            <label for="products.{{ $key }}.quantity"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Cantidad
                            </label>
                            <input type="text" id="quantity" wire:model="products.{{ $key }}.quantity"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="shield_{{ $key }}_quantity" required>
                            @error("products.$key.quantity")
                                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                            @if (session()->has('ProductMessage'))
                                <p class="text-sm text-red-500 font-semibold">{{ session('ProductMessage') }}</p>
                            @endif
                        </div>

                        <div class="relative z-0 w-full mb-6 group">
                            <label for="products.{{ $key }}.buyPrice"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Precio de compra
                            </label>
                            <input wire:model="products.{{ $key }}.buyPrice" type="text" id="buyPrice"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="shield_{{ $key }}_buyPrice" required>
                            @error("products.$key.buyPrice")
                                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 sm:gap-4">
                        <div class="relative z-0 w-full mb-6 group">
                            <label for="products.{{ $key }}.product" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">
                                Seleccione un producto
                            </label>
                            <select wire:model="products.{{ $key }}.product" id="products.{{ $key }}.product"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" selected>--Seleccione--</option>
                                @foreach ($productsSubstore as $product)
                                    <option value="{{ $product['subStoreProduct_id'] }}">
                                        {{ $product['subStoreProductMobileId'] }} - {{ $product['name'] }}</option>
                                @endforeach
                            </select>
                            @error("products.$key.product")
                                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative z-0 w-full mb-6 group">
                            <label for="products.{{ $key }}.note"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Nota del producto
                            </label>
                            <textarea wire:model="products.{{ $key }}.note" name="shield_{{ $key }}_note" id="note"
                                rows="8" maxlength="500"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 resize-none rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </textarea>
                            @error("products.$key.note")
                                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center">
                    <button class="bg-red-500  rounded-lg py-2.5 px-4  ml-2 my-4 text-white text-sm font-bold"
                        wire:click="removeShield('{{ $key }}')">
                        Eliminar
                    </button>
                </div>
                @if ($loop->last)
                    <button wire:click="addShield"
                        class="bg-green-600 rounded-lg py-2.5 px-4  ml-2 my-4 text-white text-sm font-bold">Agregar
                        Producto</button>
                @endif
                <hr class="h-px my-8 bg-black border-0">
            @endforeach
        </div>
    </div>

    <div class="flex gap-2 justify-center">
        <button wire:click='save'
            class="text-white bg-pink-custom-600 hover:bg-pink-custom-850 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Agregar Pedido
        </button>
        <button
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            Volver
        </button>
    </div>
</div>
