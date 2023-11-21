<div>
    @if (session()->has('password'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">Administrador de tienda creado con éxito</span>
            Recuerde suministrar su contraseña al administrador creado.
            <button id="btn">
                Mostrar contraseña
            </button>
            <input type="hidden" id="password" name="password" value="{{ session('password') }}">
        </div>
    @endif
    {{-- SubStore Form --}}
    <div class="bg-white p-4 rounded-sm" wire:ignore.self>
        <div class="relative z-0 w-full mb-6 group">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Nombre Sucursal
            </label>
            <input wire:model="name" type="text" name="name" id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder=" " required />
            @error('name')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Dirección
            </label>
            <input wire:model="address" type="text" name="address" id="address"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder=" " required />
            @error('address')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <input wire:model="latitude" type="hidden" name="latitude" id="latitude" />
        <input wire:model="longitude" type="hidden" name="longitude" id="longitude" />

        <div class="grid sm:grid-cols-2 sm:gap-4">
            <div class="relative z-0 w-full mb-6 group">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Teléfono
                </label>
                <input wire:model="phone" type="tel" name="phone" id="phone"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="" />
                @error('phone')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <label for="commission" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Comisión
                </label>
                <input wire:model="commission" type="number" min="0.00001" name="commission" id="commission"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="" />
                @error('commission')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="my-8">
            <button wire:click="returnStoresManagement"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                type="button">
                Volver</button>
            <button
                class="text-white  bg-pink-custom-600 hover:bg-pink-custom-850 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                type="button" wire:click="addSubStore">
                Crear Sucursal
            </button>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps_api_key') }}&libraries=places&callback=initialize">
    </script>

    <script type="text/javascript">
        function initialize() {
            let input = document.getElementById('address');
            let autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {
                let place = autocomplete.getPlace();
                console.log(place.formatted_address);
                @this.set('address', place.formatted_address);
                @this.set('latitude', place.geometry.location.lat());
                @this.set('longitude', place.geometry.location.lng());
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const password = document.getElementById('password').value;
            if (password) {
                Swal.fire({
                    title: 'Recuerda copiar la contraseña de tu administrador',
                    text: password,
                    icon: 'info',
                    confirmButtonColor: '#FF5C77',
                    confirmButtonText: 'Cancelar',
                })
            }
        });
    </script>

    <script>
        const button = document.getElementById('btn');
        if (button) {
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
