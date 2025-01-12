<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Beranda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-6">
                        <!-- Card 1 -->
                        <div class="bg-blue-500 text-white rounded-lg shadow-lg p-6 transition duration-200 hover:shadow-xl">
                            <h3 class="text-lg font-semibold mb-4">Daftarkan Akun</h3>
                            <p class="mb-4">Buat akun baru untuk pengguna dengan mudah dan cepat.</p>
                            <a href="{{ route('pengguna.create') }}" 
                                class="bg-white text-blue-500 rounded-lg px-4 py-2 font-medium hover:bg-gray-100">
                                Daftar Sekarang
                            </a>
                        </div>

                        <!-- Card 2 -->
                        <div class="bg-blue-500 text-white rounded-lg shadow-lg p-6 transition duration-200 hover:shadow-xl">
                            <h3 class="text-lg font-semibold mb-4">Daftarkan Gereja</h3>
                            <p class="mb-4">Tambah data gereja baru untuk akses sistem yang lebih lengkap.</p>
                            <a href="{{ route('gereja.create') }}" 
                                class="bg-white text-blue-500 rounded-lg px-4 py-2 font-medium hover:bg-gray-100">
                                Tambah Gereja
                            </a>
                        </div>

                        <!-- Card 3 -->
                        <div class="bg-blue-500 text-white rounded-lg shadow-lg p-6 transition duration-200 hover:shadow-xl">
                            <h3 class="text-lg font-semibold mb-4">Kelola Pengguna</h3>
                            <p class="mb-4">Atur dan kelola pengguna yang sudah terdaftar di sistem.</p>
                            <a href="{{ route('admin.dashboard') }}" 
                                class="bg-white text-blue-500 rounded-lg px-4 py-2 font-medium hover:bg-gray-100">
                                Kelola Sekarang
                            </a>
                        </div>

                        <!-- Card 4 -->
                        <div class="bg-blue-500 text-white rounded-lg shadow-lg p-6 transition duration-200 hover:shadow-xl">
                            <h3 class="text-lg font-semibold mb-4">Tentang Aplikasi</h3>
                            <p class="mb-4">Pelajari lebih lanjut tentang fitur dan manfaat aplikasi ini.</p>
                            <a href="#" 
                                class="bg-white text-blue-500 rounded-lg px-4 py-2 font-medium hover:bg-gray-100">
                                Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
