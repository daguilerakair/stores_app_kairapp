<div>

    @if (!empty($successMessage))
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endif

    {{-- Store Form --}}
    <div class="bg-white p-4 rounded-sm" wire:ignore.self>
        <h3 class="font-bold mb-4 text-xl uppercase text-black">Información tienda</h3>
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <input wire:model="rut" type="text" name="rut" id="rut"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" required />
                @error('rut')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
                @if (session()->has('message'))
                    <p class="text-sm text-red-500 font-semibold">{{ session('message') }}</p>
                @endif
                <label for="rut"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    RUT
                </label>
            </div>
            <div class="relative z-0 w-1/4 mb-6 group">
                <input wire:model="checkDigit" type="text" name="checkDigit" id="checkDigit"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                @error('checkDigit')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
                <label for="checkDigit"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-0 sm:top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Dígito verificador
                </label>
            </div>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input wire:model="companyName" type="text" name="floating_name" id="floating_name"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            @error('companyName')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
            <label for="floating_name"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Nombre Compañia
            </label>
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <input wire:model="fantasyName" type="text" name="floating_name" id="floating_name"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            @error('fantasyName')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
            <label for="floating_name"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Nombre Fantasia
            </label>
        </div>

        {{-- Radio --}}
        <div class="flex gap-2 items-center mb-4">
            <h3 class="font-semibold text-gray-900 dark:text-white">¿La tienda es itinerante?</h3>
            <button data-tooltip-target="tooltip-right" data-tooltip-placement="right" type="button"
                class=" text-white bg-transparent ">
                <svg class="w-7 h-7 text-blue-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 9h2v5m-2 0h4M9.408 5.5h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </button>

            <div id="tooltip-right" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Tienda itinerante se refiere a que puede no tener una ubicación fija.
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </div>
        <div class="mb-4">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-2">
                    <input checked id="check-radio" type="radio" wire:model='radioCheckedItinerant' value="Y"
                        name="default-radio"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        Si
                    </label>
                </div>
                <div class="flex items-center gap-2">
                    <input id="no-check-radio" type="radio" wire:model='radioCheckedItinerant' value="N"
                        name="default-radio"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        No
                    </label>
                </div>
            </div>
        </div>

        {{-- Radio --}}
        <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">¿La tienda vende productos personalizados?</h3>
        <div class="mb-4">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-2">
                    <input checked id="check-radio-custom" type="radio" wire:model='radioCheckedCustom' value="Y"
                        name="default-radio-custom"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-custom-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        Si
                    </label>
                </div>
                <div class="flex items-center gap-2">
                    <input id="no-check-radio-custom" type="radio" wire:model='radioCheckedCustom' value="N"
                        name="default-radio-custom"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-custom-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        No
                    </label>
                </div>
            </div>
        </div>

        {{-- Administrator Info --}}
        <h3 class="font-bold mb-4 text-xl uppercase text-black">Información administrador de la tienda</h3>
        <div class="relative z-0 w-full mb-6 group">
            <input wire:model="nameAdmin" type="text" name="nameAdmin" id="nameAdmin"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder="" required />
            @error('nameAdmin')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
            <label for="nameAdmin"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Nombre administrador
            </label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input wire:model="email" type="text" name="email" id="email"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder="" required />
            @error('email')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
            <label for="email"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Correo electrónico
            </label>
        </div>
    </div>

    <div class="my-8">
        <button wire:click="returnStoresManagement"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
            type="button">
            Volver</button>
        <button
            class="text-white  bg-pink-custom-600 hover:bg-pink-custom-850 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
            wire:click="addStore" type="button">Crear Tienda</button>
    </div>
</div>
