<div class="bg-white p-4 rounded-sm">
    <div wire:ignore.self>
        <div class="relative z-0 w-full mb-6 group">
            <input wire:model="name" type="text" name="floating_name" id="floating_name"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder="" required />
            @error('name')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
            <label for="floating_name"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Nombre
            </label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input wire:model="email" type="text" name="repeat_password" id="floating_repeat_password"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            @error('email')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
            <label for="floating_repeat_password"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Correo electrónico
            </label>
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <label for="subStores" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Rol usuario</label>
            <select id="subStores" wire:model='role'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">--Seleccione--</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <label for="subStores" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Sucursal</label>
            <select id="subStores" wire:model='subStoreUser'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">--Seleccione--</option>
                @foreach ($subStores as $subStore)
                    <option value="{{ $subStore->id }}">{{ $subStore->name }}</option>
                @endforeach
            </select>
            @error('subStoreUser')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="flex gap-2 justify-center">
        <button wire:click="save"
            class="text-white  bg-pink-custom-600 hover:bg-pink-custom-850 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Agregar Trabajador
        </button>
        <button wire:click="returnCollaborators"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            Volver
        </button>
    </div>
</div>
