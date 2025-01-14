<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Informasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Tombol Bookmark -->
                <div class="flex justify-start mb-6 space-x-4">
                    <!-- Tombol Sub-Halaman 1 -->
                    <button 
                        onclick="showPage('page-1')" 
                        id="btn-page-1"
                        class="relative px-6 py-2 text-gray-700 bg-gray-200 hover:bg-blue-500 hover:text-white font-medium rounded-t-lg shadow-md transition duration-300 ease-in-out">
                        <span class="absolute inset-0 rounded-t-lg bg-blue-500 opacity-0 hover:opacity-100 transition-opacity duration-300 ease-in-out"></span>
                        <span class="relative z-10">Laporan Keuangan Terkini</span>
                    </button>
                    <!-- Tombol Sub-Halaman 2 -->
                    <button 
                        onclick="showPage('page-2')" 
                        id="btn-page-2"
                        class="relative px-6 py-2 text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-t-lg shadow-md transition duration-300 ease-in-out">
                        <span class="absolute inset-0 rounded-t-lg bg-blue-600 opacity-0 hover:opacity-100 transition-opacity duration-300 ease-in-out"></span>
                        <span class="relative z-10">Informasi</span>
                    </button>
                </div>

                <!-- Konten Sub-Halaman -->
                <div id="page-1" class="hidden">
                    <div class="p-6 text-gray-900">
                        <p>Konten untuk Sub-Halaman 1 masih kosong, ini yg tampilan bulan terbaru dari keuangan, contoh inibulan januari brrti dpe laporan bulan desember punya, hehe</p>
                    </div>
                </div>

                <div id="page-2" class="">
                    <div class="p-6 text-gray-900">
                        <!-- Form untuk Mengedit Pengumuman -->
                        <form action="{{ route('dashboard') }}" method="POST">
                            @csrf
                            @method('POST') <!-- Ubah ke PUT jika menggunakan RESTful -->

                            <!-- Editor Teks -->
                            <label for="pengumuman" class="block text-sm font-medium text-gray-700 mb-2">Isi Pengumuman</label>
                            <textarea id="pengumuman" name="email" rows="10" class="editor w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                {!! old('email', $email ?? '') !!}
                            </textarea>

                            <!-- Tombol Simpan -->
                            <div class="mt-4">
                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-500">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan Script untuk Editor Teks -->
    <script src="https://cdn.ckeditor.com/4.25.1/full/ckeditor.js"></script>
    <script>
        // Inisialisasi CKEditor pada textarea
        CKEDITOR.replace('pengumuman', {
            toolbar: [
                ['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', '-', 'Undo', 'Redo', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight']
            ],
            removePlugins: 'elementspath',
            resize_enabled: true,
            height: 300
        });

        // Fungsi untuk Menampilkan Sub-Halaman
        function showPage(pageId) {
            const pages = ['page-1', 'page-2'];
            const buttons = ['btn-page-1', 'btn-page-2'];
            pages.forEach((id, index) => {
                const page = document.getElementById(id);
                const button = document.getElementById(buttons[index]);
                if (id === pageId) {
                    page.classList.remove('hidden');
                    button.classList.add('bg-blue-500', 'text-white');
                    button.classList.remove('bg-gray-200', 'text-gray-700');
                } else {
                    page.classList.add('hidden');
                    button.classList.remove('bg-blue-500', 'text-white');
                    button.classList.add('bg-gray-200', 'text-gray-700');
                }
            });
        }
    </script>
</x-app-layout>
