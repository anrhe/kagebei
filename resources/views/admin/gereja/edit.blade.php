<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Gereja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <button onclick="window.history.back();" class="mb-4 text-white bg-gray-500 hover:bg-gray-700 rounded-lg px-4 py-2">
                        Kembali
                    </button>
                    
                    <form action="{{ route('gereja.update', $gereja) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nama" class="block font-medium text-sm text-gray-700">Nama Gereja</label>
                            <input type="text" name="nama" id="nama" value="{{ $gereja->nama }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="alamat" class="block font-medium text-sm text-gray-700">Alamat</label>
                            <input type="text" name="alamat" id="alamat" value="{{ $gereja->alamat }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="kontak" class="block font-medium text-sm text-gray-700">Kontak</label>
                            <input type="text" name="kontak" id="kontak" value="{{ $gereja->kontak }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
