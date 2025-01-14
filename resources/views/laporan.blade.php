<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Informasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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

        // Fitur untuk mengatur tampilan 1 page atau 2 page
        function togglePageMode() {
            const editor = CKEDITOR.instances['pengumuman'];
            if (editor) {
                const currentConfig = editor.config;
                currentConfig.height = currentConfig.height === 300 ? 600 : 300; // Ubah tinggi editor
                editor.resize('100%', currentConfig.height);
            }
        }
    </script>

    <!-- Tombol Ubah Tampilan Page -->
    <div class="mt-4 text-center">
        <button onclick="togglePageMode()" type="button" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-500">
            Toggle Page Mode (1 Page / 2 Pages)
        </button>
    </div>
</x-app-layout>
