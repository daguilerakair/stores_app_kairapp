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
                    <th scope="col" class="px-6 py-3 w-1/4 bg-gray-300 dark:bg-gray-800">
                        Días
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-300 dark:bg-gray-800">
                        Jornada
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $key => $schedule)
                    <tr wire:key='{{ $key }}' class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            {{-- Lunes --}}
                            <div class="flex flex-row gap-4">
                                @foreach ($schedule['days'] as $day)
                                    <div class="flex flex-col items-center">
                                        <label for="default-checkbox"
                                            class="text-sm font-medium text-gray-900 dark:text-gray-300">
                                            {{ $day }}
                                        </label>
                                        <input wire:model="schedules.{{ $key }}.selectDays.{{ $day }}"
                                            id="{{ $key }}-{{ $day }}-checkbox" checked
                                            type="checkbox" value="{{ $day }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                @endforeach
                            </div>
                        </th>
                        <td class="px-6 py-4 bg-gray-100 dark:text-white dark:bg-gray-400">
                            <div class="flex flex-row">
                                <div class="flex flex-col w-full md:w-1/6 items-center mr-8">
                                    <button type="button" wire:click='updateSelectedSchedule'
                                        class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 transition-all focus:ring-4 focus:ring-purple-300 font-medium rounded-lg md:text-sm px-8 md:px-5 py-1 md:py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                        Jornada Continua
                                    </button>
                                    <button type="button" wire:click='viewHiddenInformation'
                                        class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 transition-all focus:ring-4 focus:ring-purple-300 font-medium rounded-lg md:text-sm px-8 md:px-5 py-1 md:py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                        Jornada Dividida
                                    </button>
                                </div>

                                <div class="flex items-center justify-center">
                                    <div class="relative">
                                        <select id="subStores" wire:model='opening' wire:change='handleSelectChange'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            {{-- @foreach ($subStores as $subStore) --}}
                                            <option value="08:00" selected>08:00</option>
                                            <option value="08:30">08:30</option>
                                            <option value="09:00">09:00</option>
                                            <option value="09:30">09:30</option>
                                            <option value="10:00">10:00</option>
                                            <option value="10:30">10:30</option>
                                            <option value="11:00">11:00</option>
                                            <option value="11:30">11:30</option>
                                            <option value="12:00">12:00</option>
                                            <option value="12:30">12:30</option>
                                            <option value="13:00">13:00</option>
                                            <option value="13:30">13:30</option>
                                            <option value="14:00">14:00</option>
                                            <option value="14:30">14:30</option>
                                            <option value="15:00">15:00</option>
                                            <option value="15:30">15:30</option>
                                            <option value="16:00">16:00</option>
                                            <option value="16:30">16:30</option>
                                            <option value="17:00">17:00</option>
                                            <option value="17:30">17:30</option>
                                            <option value="18:00">18:00</option>
                                            <option value="18:30">18:30</option>
                                            <option value="19:00">19:00</option>
                                            <option value="19:30">19:30</option>
                                            <option value="20:00">20:00</option>
                                            <option value="20:30">20:30</option>
                                            <option value="21:00">21:00</option>
                                            {{-- @endforeach --}}
                                        </select>
                                    </div>
                                    <span class="mx-4 text-gray-500">hasta</span>
                                    <div class="relative">
                                        <select id="subStores" wire:model='closing' wire:change='handleSelectChange'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            {{-- @foreach ($subStores as $subStore) --}}
                                            <option value="08:00">08:00</option>
                                            <option value="08:30">08:30</option>
                                            <option value="09:00">09:00</option>
                                            <option value="09:30">09:30</option>
                                            <option value="10:00">10:00</option>
                                            <option value="10:30">10:30</option>
                                            <option value="11:00">11:00</option>
                                            <option value="11:30">11:30</option>
                                            <option value="12:00">12:00</option>
                                            <option value="12:30">12:30</option>
                                            <option value="13:00">13:00</option>
                                            <option value="13:30">13:30</option>
                                            <option value="14:00">14:00</option>
                                            <option value="14:30">14:30</option>
                                            <option value="15:00">15:00</option>
                                            <option value="15:30">15:30</option>
                                            <option value="16:00">16:00</option>
                                            <option value="16:30">16:30</option>
                                            <option value="17:00">17:00</option>
                                            <option value="17:30">17:30</option>
                                            <option value="18:00">18:00</option>
                                            <option value="18:30">18:30</option>
                                            <option value="19:00">19:00</option>
                                            <option value="19:30">19:30</option>
                                            <option value="20:00">20:00</option>
                                            <option value="20:30">20:30</option>
                                            <option value="21:00" selected>21:00</option>
                                            {{-- @endforeach --}}
                                        </select>
                                    </div>
                                </div>

                                @if ($viewOptionalSchedules)
                                    <div class="flex items-center">
                                        <div class="relative">
                                            <select id="subStores" wire:model='openingOptional'
                                                wire:change='handleSelectChange'
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                {{-- @foreach ($subStores as $subStore) --}}
                                                <option value="08:00" selected>08:00</option>
                                                <option value="08:30">08:30</option>
                                                <option value="09:00">09:00</option>
                                                <option value="09:30">09:30</option>
                                                <option value="10:00">10:00</option>
                                                <option value="10:30">10:30</option>
                                                <option value="11:00">11:00</option>
                                                <option value="11:30">11:30</option>
                                                <option value="12:00">12:00</option>
                                                <option value="12:30">12:30</option>
                                                <option value="13:00">13:00</option>
                                                <option value="13:30">13:30</option>
                                                <option value="14:00">14:00</option>
                                                <option value="14:30">14:30</option>
                                                <option value="15:00">15:00</option>
                                                <option value="15:30">15:30</option>
                                                <option value="16:00">16:00</option>
                                                <option value="16:30">16:30</option>
                                                <option value="17:00">17:00</option>
                                                <option value="17:30">17:30</option>
                                                <option value="18:00">18:00</option>
                                                <option value="18:30">18:30</option>
                                                <option value="19:00">19:00</option>
                                                <option value="19:30">19:30</option>
                                                <option value="20:00">20:00</option>
                                                <option value="20:30">20:30</option>
                                                <option value="21:00">21:00</option>
                                                {{-- @endforeach --}}
                                            </select>
                                        </div>
                                        <span class="mx-4 text-gray-500">hasta</span>
                                        <div class="relative">
                                            <select id="subStores" wire:model='closingOptional'
                                                wire:change='handleSelectChange'
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                {{-- @foreach ($subStores as $subStore) --}}
                                                <option value="08:00">08:00</option>
                                                <option value="08:30">08:30</option>
                                                <option value="09:00">09:00</option>
                                                <option value="09:30">09:30</option>
                                                <option value="10:00">10:00</option>
                                                <option value="10:30">10:30</option>
                                                <option value="11:00">11:00</option>
                                                <option value="11:30">11:30</option>
                                                <option value="12:00">12:00</option>
                                                <option value="12:30">12:30</option>
                                                <option value="13:00">13:00</option>
                                                <option value="13:30">13:30</option>
                                                <option value="14:00">14:00</option>
                                                <option value="14:30">14:30</option>
                                                <option value="15:00">15:00</option>
                                                <option value="15:30">15:30</option>
                                                <option value="16:00">16:00</option>
                                                <option value="16:30">16:30</option>
                                                <option value="17:00">17:00</option>
                                                <option value="17:30">17:30</option>
                                                <option value="18:00">18:00</option>
                                                <option value="18:30">18:30</option>
                                                <option value="19:00">19:00</option>
                                                <option value="19:30">19:30</option>
                                                <option value="20:00">20:00</option>
                                                <option value="20:30">20:30</option>
                                                <option value="21:00" selected>21:00</option>
                                                {{-- @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                <div class="ml-8 md:mx-auto my-auto">
                                    <a wire:click="removeShield('{{ $key }}')"
                                        class="cursor-pointer text-white bg-pink-custom-600 hover:bg-pink-custom-850 transition-all focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                        X
                                    </a>
                                </div>

                                {{-- <p>{{ $key }}</p> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if (session()->has('scheduleMessage'))
        <p class="text-md text-red-500 font-semibold">{{ session('scheduleMessage') }}</p>
    @endif
    <div class="mx-auto my-8">
        <a wire:click='addShield'
            class="cursor-pointer text-white bg-pink-custom-600 hover:bg-pink-custom-850 transition-all focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
            Añadir Jornada
        </a>
    </div>

    <div class="mx-auto">
        <a wire:click='save'
            class="cursor-pointer text-white bg-pink-custom-600 hover:bg-pink-custom-850 transition-all focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
            Guardar
        </a>
    </div>
</div>
