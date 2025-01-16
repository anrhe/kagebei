<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <!-- Back Button -->
            <button onclick="window.history.back()" 
                class="text-gray-800 hover:text-gray-600 transition duration-200 flex items-center focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                <span class="font-medium">{{ __('Kembali') }}</span>
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Form -->
                    <form action="{{ route('pengumuman.store') }}" method="POST">
                        @csrf

                        <!-- Judul -->
                        <div class="mb-4">
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                            <input type="text" name="judul" id="judul" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('judul') }}" required>
                            @error('judul')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Isi -->
                        <div class="mb-4">
                            <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">Isi</label>
                            <textarea name="isi" id="isi" rows="10" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('isi') }}</textarea>
                            @error('isi')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                                Simpan
                            </button>
                            <a href="{{ route('pengumuman.index') }}" class="ml-2 text-gray-600 hover:text-blue-500">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- CKEditor Integration -->
    <script>
        CKEDITOR.replace('isi', {
            toolbar: [
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'insert', items: ['Image', 'Table', 'HorizontalRule'] },
                { name: 'styles', items: ['Styles', 'Format'] },
                { name: 'tools', items: ['Maximize'] }
            ],
            removePlugins: 'elementspath',
            resize_enabled: true,
            height: 300
        });
    </script>
</x-app-layout>
