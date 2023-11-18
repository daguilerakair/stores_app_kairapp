<div class="bg-white p-4 rounded-sm">
    <div wire:ignore.self>
        <div class="relative z-0 w-full mb-6 group">
            <label for="floating_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Nombre
            </label>
            <input wire:model="name" type="text" name="floating_name" id="floating_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" required />
            @error('name')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="floating_repeat_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Descripción
            </label>
            <input wire:model="description" type="text" name="repeat_password" id="floating_repeat_password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder=" " required />
            @error('description')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <label for="floating_first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Precio
                </label>
                <input wire:model="price" type="text" name="floating_first_name" id="floating_first_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder=" " required />
                @error('price')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <label for="floating_last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Cantidad disponible
                </label>
                <input wire:model="stock" type="text" name="floating_last_name" id="floating_last_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder=" " required />
                @error('stock')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    <div class="flex gap-2 justify-center">
        <button wire:click="save"
            class="text-white  bg-pink-custom-600 hover:bg-pink-custom-850 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Editar Producto
        </button>
        <button wire:click="returnInventory"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            Volver
        </button>
    </div>
</div>
