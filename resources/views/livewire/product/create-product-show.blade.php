@push('css')
    @vite(['resources/css/spinner.css)'])
@endpush
<div class="bg-white p-4 rounded-sm">
    <div class="lds-hourglass"></div>
    <div wire:ignore.self>
        <div class="relative z-0 w-full mb-6 group">
            <input wire:model="name" type="text" name="floating_name" id="floating_name"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            @error('name')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
            <label for="floating_name"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Nombre
            </label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input wire:model="description" type="text" name="repeat_password" id="floating_repeat_password"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            @error('description')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
            <label for="floating_repeat_password"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Descripción
            </label>
        </div>
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <input wire:model="price" type="text" name="floating_first_name" id="floating_first_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                @error('price')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
                <label for="floating_first_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Precio
                </label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input wire:model="stock" type="text" name="floating_last_name" id="floating_last_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                @error('stock')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
                <label for="floating_last_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Cantidad disponible
                </label>
            </div>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">
                Seleccione una categoria
            </label>
            <select wire:model="category" id="categories" wire:change='changedSelectCategory'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" selected>--Seleccione--</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>
        <div class="grid md:grid-cols-2">
            @foreach ($characteristics as $key => $chara)
                <div class="mb-6 mx-auto w-3/4">
                    <label for="base-input"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $chara['name'] }}</label>
                    <input type="text" id="base-input" wire:model='characteristics.{{ $key }}.value'
                        value=""
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error("characteristics.$key.value")
                        <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <input wire:model="images" type="file" name="image" id="image" multiple
                class="block py-2.5 my-4 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                required />
            @error('images.*')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
            <label for="images"
                class="peer-focus:font-medium absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500">
                Imagen
            </label>
        </div>
        @if ($this->images)
            @foreach ($this->images as $index => $image)
                <div class="flex flex-col">
                    <img class="w-1/6 h-48 max-w-lg my-4 rounded-lg" src="{{ $image->temporaryUrl() }}" alt="">
                    <form wire:submit.prevent="removeImage({{ $index }})">
                        <button type="submit" class="top-2 right-2 text-red-500">Eliminar</button>
                    </form>
                </div>
            @endforeach
        @endif

        {{-- Checkboxes --}}
        <div id="subStores-list" class="hidden">
            <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Listado Sucursales</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                @foreach ($subStores as $subStore)
                    <div class="flex items-center mb-4 gap-2">
                        <input id="default-checkbox" type="checkbox" value="{{ $subStore->id }}"
                            wire:model='selectedItems'
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ $subStore->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex gap-2 justify-center">
        <button wire:click="save" wire:loading.attr="disabled" @if ($disabledButton) disabled @endif
            class="text-white  bg-pink-custom-600 hover:bg-pink-custom-850 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Agregar Producto
        </button>
        <button wire:click="returnInventory"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            Volver
        </button>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const checkRadioSubStore = document.getElementById('check-radio');
            const noCheckRadioSubStore = document.getElementById('no-check-radio');

            const listSubStore = document.getElementById('subStores-list');

            checkRadioSubStore.addEventListener('change', () => {
                listSubStore.classList.add('hidden');
            });

            noCheckRadioSubStore.addEventListener('change', () => {
                listSubStore.classList.remove('hidden');
            });
        });
    </script>
@endpush
