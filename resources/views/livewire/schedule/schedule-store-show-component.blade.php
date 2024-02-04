<div>
    <div>
        <label for="subStores" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Sucursal
        </label>
        <select id="subStores" wire:model='selectedOption' wire:change='handleSelectChange'
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            {{-- @foreach ($subStores as $subStore) --}}
            <option value="">Ejemplo</option>
            {{-- @endforeach --}}
        </select>
    </div>



    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 w-1/4 bg-gray-50 dark:bg-gray-800">
                        Día
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jornada
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Lunes
                    </th>
                    <td class="px-6 py-4">
                        <div class="flex flex-row justify-around">
                            <div class="flex xl:flex-col w-1/6">
                                <button type="button"
                                    class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 transition-all focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                    Jornada Continua
                                </button>
                                <button type="button"
                                    class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 transition-all focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                    Jornada Dividida
                                </button>
                            </div>

                            <div class="flex items-center">
                                <div class="relative">
                                    <select id="subStores" wire:model='selectedOption' wire:change='handleSelectChange'
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        {{-- @foreach ($subStores as $subStore) --}}
                                        <option value="">Ejemplo</option>
                                        {{-- @endforeach --}}
                                    </select>
                                </div>
                                <span class="mx-4 text-gray-500">to</span>
                                <div class="relative">
                                    <select id="subStores" wire:model='selectedOption' wire:change='handleSelectChange'
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        {{-- @foreach ($subStores as $subStore) --}}
                                        <option value="">Ejemplo</option>
                                        {{-- @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Martes
                    </th>
                    <td class="px-6 py-4">
                        White
                    </td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Miercoles
                    </th>
                    <td class="px-6 py-4">
                        Black
                    </td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Jueves
                    </th>
                    <td class="px-6 py-4">
                        Gray
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
