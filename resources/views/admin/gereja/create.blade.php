<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header dengan garis bawah -->
                    <h2 class="font-semibold text-xl mt-6 pb-2 text-gray-800 leading-tight inline-block border-b-2 border-gray-500 mb-6">
                        {{ __('Tambah Gereja') }}
                    </h2>
                    
                    <form action="{{ route('gereja.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nama" class="block font-medium text-sm text-gray-700">Nama Gereja</label>
                            <input type="text" name="nama" id="nama" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="alamat" class="block font-medium text-sm text-gray-700">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="kontak" class="block font-medium text-sm text-gray-700">Kontak</label>
                            <input type="text" name="kontak" id="kontak" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('kontak')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <!-- Tombol Kembali -->
                            <button onclick="window.history.back()" 
                                class="text-gray-800 hover:text-gray-600 transition duration-200 flex items-center focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>

                            <!-- Tombol Simpan -->
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="py-10 text-center text-sm" style="color: #a2abbd !important;">
            BAPTIS v1.0 Initial Release
        </footer>
    </div>
</x-app-layout>
