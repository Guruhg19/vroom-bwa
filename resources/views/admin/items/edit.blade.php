    <x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
        <a href="#!" onclick="window.history.go(-1); return false;">
            ←
        </a>
        Item &raquo; Sunting &raquo; #{{ $item->id }} {{ $item->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div>
            @if ($errors->any())
            <div class="mb-5" role="alert">
                <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                Ada kesalahan!
                </div>
                <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                <p>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </p>
                </div>
            </div>
            @endif
            <form class="w-full" action="{{ route('admin.items.update', $item->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                <div class="w-full">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                    Nama*
                </label>
                <input value="{{ old('name') ?? $item->name }}" name="name"
                        class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-last-name" type="text" placeholder="Nama" required>
                <div class="mt-2 text-sm text-gray-500">
                    Nama items. Contoh: Item 1, Item 2, Item 3, dsb. Wajib diisi. Maksimal 255 karakter.
                </div>
                </div>
            </div>

            <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                <div class="w-full">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                    Brand*
                </label>
                <select name="brand_id" id="" required class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="{{ $item->brand->id }}" selected>Tidak Diubah ( {{ $item->brand->name }} )</option>
                <option disabled>------------------------------------</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
                <div class="mt-2 text-sm text-gray-500">
                    Brand items. Contoh: Porsche, Toyota, Honda, dsb. Wajib diisi.
                </div>
                </div>
            </div>

            <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                <div class="w-full">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                    Type*
                </label>
                <select name="type_id" id="" required class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="{{ $item->type->id }}" selected>Tidak Diubah ( {{ $item->type->name }} )</option>
                <option disabled>------------------------------------</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
                <div class="mt-2 text-sm text-gray-500">
                    Type items. Contoh: SUV, Sedan, Hatchback, dsb. Wajib diisi.
                </div>
                </div>
            </div>

            <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                <div class="w-full">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                    Fitur*
                </label>
                <input value="{{ old('features') ?? $item->features }}" name="features"
                        class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-last-name" type="text" placeholder="Fitur" required>
                <div class="mt-2 text-sm text-gray-500">
                    Nama fitur. Contoh: Speedometer, GPS, Airbag, dsb. Dipisahkan dengan koma (,). 
                </div>
                </div>
            </div>

            <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                <div class="w-full">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                    Foto*
                </label>
                <input name="photos[]"
                        class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-last-name" type="file" multiple accept="image/png, image/jpg, image/jpeg, image/webp">
                <div class="mt-2 text-sm text-gray-500">
                    Foto Item dapat diisi lebih dari satu. Ukuran maksimal 2MB per foto. Format foto yang didukung: JPG, JPEG, PNG, Webp. (Opsional)
                </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-3 px-3 mt-4 mb-6 md:grid-cols-3">
                <!-- Kolom Harga -->
                <div class="w-full">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                        Harga*
                    </label>
                    <input value="{{ old('price') ?? $item->price }}" name="price"
                        class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        type="number" placeholder="Harga">
                    <div class="mt-2 text-sm text-gray-500">
                        Harga items. Contoh: 1990000, 2000000, 3500000, dsb. Wajib diisi. 
                    </div>
                </div>

                <!-- Kolom Rating -->
                <div class="w-full">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                        Rating*
                    </label>
                    <input value="{{ old('star') ?? $item->star }}" name="star"
                        class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        type="number" placeholder="Rating" min="1" max="5" step="0.1">
                    <div class="mt-2 text-sm text-gray-500">
                        Rating items. Contoh: 1, 2, 3, 4, 5. Opsional. 
                    </div>
                </div>

                <!-- Kolom Review -->
                <div class="w-full">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                        Review*
                    </label>
                    <input value="{{ old('review') ?? $item->review }}" name="review"
                        class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        type="number" placeholder="Review">
                    <div class="mt-2 text-sm text-gray-500">
                        Review items. Opsional.
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap mb-6 -mx-3">
                <div class="w-full px-3 text-right">
                <button type="submit"
                        class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                    Simpan Item
                </button>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
    </x-app-layout>