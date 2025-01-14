<x-app-layout>
    <div 
    @if (Auth::user()->role == 'admin')
        class="py-0"
        
    @endif class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-6">
                        @if (Auth::user()->role == 'admin')
                            <!-- Card 1 -->
                            <div class="text-blu'e-950 rounded-lg shadow-lg p-6 transition duration-200 hover:shadow-xl" style="background-color: #a6c4ff !important;">
                                <h3 class= "text-xl font-semibold mb-4">Buat Akun Pengguna</h3>
                                <p class="mb-4">Buat akun baru untuk pengguna dengan mudah dan cepat.</p>
                                <a href="{{ route('pengguna.create') }}" 
                                    class="bg-white text-blue-500 rounded-lg px-4 py-2 font-medium hover:bg-gray-100">
                                    Daftar Sekarang
                                </a>
                            </div>

                            <!-- Card 2 -->
                            <div class="text-blu'e-950 rounded-lg shadow-lg p-6 transition duration-200 hover:shadow-xl" style="background-color: #a6c4ff !important;">
                                <h3 class= "text-xl font-semibold mb-4" >Daftarkan Gereja</h3>
                                <p class="mb-4">Tambah data gereja baru untuk akses sistem yang lebih lengkap.</p>
                                <a href="{{ route('gereja.create') }}" 
                                    class="bg-white text-blue-500 rounded-lg px-4 py-2 font-medium hover:bg-gray-100">
                                    Tambah Gereja
                                </a>
                            </div>

                        {{-- <!-- Card 3 -->
                            <div class="bg-blue-500 text-white rounded-lg shadow-lg p-6 transition duration-200 hover:shadow-xl">
                                <h3 class="text-lg font-semibold mb-4">Kelola Pengguna</h3>
                                <p class="mb-4">Atur dan kelola pengguna yang sudah terdaftar di sistem.</p>
                                <a href="{{ route('admin.dashboard') }}" 
                                    class="bg-white text-blue-500 rounded-lg px-4 py-2 font-medium hover:bg-gray-100">
                                    Kelola Sekarang
                                </a>
                            </div> --}}
                        @endif

                        @if (Auth::user()->role == 'user')
                            <!-- Card 1 -->
                            <div class="text-blu'e-950 rounded-lg shadow-lg p-6 transition duration-200 hover:shadow-xl" style="background-color: #a6c4ff !important;">
                                <h3 class= "text-xl font-semibold mb-4">Lihat Profil Jemaat</h3>
                                <p class="mb-4">Lihat jemaat gereja yang sudah terdaftar di sistem.</p>
                                <a href="{{ route('admin.gereja.dashboard') }}" 
                                    class="bg-white text-blue-500 rounded-lg px-4 py-2 font-medium hover:bg-gray-100">
                                    Lihat Jemaat
                                </a>
                            </div>
                        @endif

                        @if (Auth::user()->role == 'operator' || Auth::user()->role == 'gembala')
                            <!-- Card 1 -->
                            <div class="text-blu'e-950 rounded-lg shadow-lg p-6 transition duration-200 hover:shadow-xl" style="background-color: #a6c4ff !important;">
                                <h3 class= "text-xl font-semibold mb-4">Kelola Jemaat Gereja</h3>
                                <p class="mb-4">Atur dan kelola jemaat gereja yang sudah terdaftar di sistem.</p>
                                <a href="{{ route('admin.gereja.dashboard') }}" 
                                    class="bg-white text-blue-500 rounded-lg px-4 py-2 font-medium hover:bg-gray-100">
                                    Kelola Jemaat
                                </a>
                            </div>
                        @endif

                        @if (Auth::user()->role == 'operator')
                            <!-- Card 2 -->
                            <div class="text-blu'e-950 rounded-lg shadow-lg p-6 transition duration-200 hover:shadow-xl" style="background-color: #a6c4ff !important;">
                                <h3 class= "text-xl font-semibold mb-4">Kelola Keuangan</h3>
                                <p class="mb-4">Atur dan kelola keuangan gereja sehingga menjadi lebih mudah untuk dilihat.</p>
                                <a href="{{ route('laporan.summary') }}" 
                                    class="bg-white text-blue-500 rounded-lg px-4 py-2 font-medium hover:bg-gray-100">
                                    Kelola Keuangan
                                </a>
                            </div>
                        @endif

                        @if (Auth::user()->role == 'gembala' || Auth::user()->role == 'user')
                            <!-- Card 2 -->
                            <div class="text-blu'e-950 rounded-lg shadow-lg p-6 transition duration-200 hover:shadow-xl" style="background-color: #a6c4ff !important;">
                                <h3 class= "text-xl font-semibold mb-4">Laporan Keuangan</h3>
                                <p class="mb-4">Lihat laporan keuangan gereja anda dengan mudah dan cepat</p>
                                <a href="{{ route('laporan.summary') }}" 
                                    class="bg-white text-blue-500 rounded-lg px-4 py-2 font-medium hover:bg-gray-100">
                                    Lihat Laporan Keuangan
                                </a>
                            </div>
                        @endif

                        <!-- Card 4 -->
                        <div class="text-blu'e-950 rounded-lg shadow-lg p-6 transition duration-200 hover:shadow-xl" style="background-color: #a6c4ff !important;">
                                <h3 class= "text-xl font-semibold mb-4">Tentang Aplikasi</h3>
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
