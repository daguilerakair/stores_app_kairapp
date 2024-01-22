@push('dropzone')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endpush

<div class="bg-white p-4 rounded-sm">
    <div class="lds-hourglass"></div>
    <div wire:ignore.self>
        {{-- Input for product name --}}
        <div class="relative z-0 w-full mb-6 group">
            <label for="floating_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Nombre
            </label>
            <input wire:model="name" type="text" name="floating_name" id="floating_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder=" " required />
            @error('name')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input for product description --}}
        <div class="relative z-0 w-full mb-6 group">
            <label for="floating_repeat_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Descripción
            </label>
            <textarea wire:model="description" name="description" id="description" rows="8" maxlength="1000"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 resize-none rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" required></textarea>
            @error('description')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Grid for price and stock inputs --}}
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

            {{-- Input for product stock --}}
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

        {{-- Select for product category --}}
        {{-- <div class="relative z-0 w-full mb-6 group">
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
        </div> --}}

        {{-- Inputs for product characteristics --}}
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


        <div>
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Seleccione las categorías del producto
            </label>
            <div class="relative overflow-x-auto w-72 sm:w-full shadow-md sm:rounded-lg mb-8">
                <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-start">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w- h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" id="table-search"
                            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-44 sm:w-72 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Busca tu categoría">
                    </div>

                    <button type="submit"
                        class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 transition-all focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>

                    <button type="submit"
                        class="p-2.5 ms-2 text-sm font-medium text-white bg-yellow-400 rounded-lg border border-yellow-400 hover:bg-yellow-600 transition-all focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4 text-white dark:text-white hover:animate-spin" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 1v5h-5M2 19v-5h5m10-4a8 8 0 0 1-14.947 3.97M1 10a8 8 0 0 1 14.947-3.97" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
                <table class="w-72 sm:w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-all-search" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nombre Categoría
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            {{-- <option value="{{ $category->id }}">{{ $category->name }}</option> --}}
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-table-search-1" type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                    </div>
                                </td>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $category->name }}
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Dropzone for uploading images --}}
        <div class="mb-6">
            <label for="images" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Subir imagenes
            </label>
            <form action="{{ route('dropzone.storeTemp') }}" method="POST" enctype="multipart/form-data"
                id="image-upload" class="dropzone border-dashed border-2">
                @csrf
            </form>
            <input wire:model='images' hidden />
            @error('images')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Buttons for submitting and returning --}}
    <div wire:loading.remove wire:target="save" class="flex gap-2 justify-center">
        <button wire:click="save" wire:loading.attr="disabled" @if ($disabledButton) disabled @endif
            class="text-white bg-pink-custom-600 hover:bg-pink-custom-850 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Agregar Producto
        </button>
        <button wire:click="returnInventory"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            Volver
        </button>
    </div>
    <div class="flex justify-center">
        <div wire:loading wire:target="save" class="text-center">
            <div role="status">
                <svg aria-hidden="true"
                    class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-pink-custom-600"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script type="text/javascript">
        // Get the CSRF token from the meta tag in the document head
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        // Listen for the Livewire initialized event
        document.addEventListener('livewire:initialized', () => {
            // Create a new Dropzone instance with specified options
            const dropzone = new Dropzone("#image-upload", {
                dictDefaultMessage: "Haz click aqui para subir las imagenes de tu producto",
                maxFiles: 5,
                maxFileSize: 2,
                acceptedFiles: ".jpeg,.jpg,.png, .webp, .heif,.heic,.hevc",
                addRemoveLinks: true,
                dictRemoveFile: "Borrar imagen",
                dictFallbackMessage: "Tu navegador no soporta la carga de archivos mediante arrastrar y soltar.",
                dictInvalidFileType: "No puedes subir archivos con esa extension.",
                dictMaxFilesExceeded: "No puedes subir más archivos. Límite alcanzado.",
                dictFileTooBig: "El archivo es demasiado grande. Tamaño máximo de archivo: 2MB.",
            });

            // Event listener for a successful file upload
            dropzone.on('success', function(file, response) {
                // Dispatch Livewire event to add the uploaded image
                const {
                    name,
                    type,
                    size
                } = file;

                const imageInfo = {
                    path: response,
                    name,
                    extension: type.split('/')[1],
                    size: formatBytes(size),
                }

                // console.log(imageInfo);
                @this.dispatch('addImage', {imageInfo});
            });

            // Event listener for removing a file
            dropzone.on('removedfile', async function(file, message) {
                try {
                    // Extract the image URL from the response
                    const imageUrl = file.xhr.response;
                    const imageUrlFormatted = imageUrl.replaceAll('"', '');
                    const imageUrlFormattedPath =imageUrlFormatted.replace(/\\\//g, '/');

                    // Format the image response and dispatch Livewire event to remove the image
                    @this.dispatch('removeImage', {
                        path: imageUrlFormattedPath,
                    });
                } catch (error) {
                    console.error('Error al eliminar la imagen del servidor.');
                }
            });
        });

        function formatBytes(bytes) {
            let kilobytes = bytes / 1024;
            let megabytes = kilobytes / 1024;

            if (megabytes >= 1) {
                return megabytes.toFixed(2) + " MB";
            } else {
                return kilobytes.toFixed(2) + " KB";
            }
        }
    </script>
@endpush
