<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Informasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <!-- Tabs -->
                <div class="flex border-b border-gray-200">
                    <!-- Tab Button 1 -->
                    <button 
                        onclick="showPage('page-1')" 
                        id="btn-page-1" 
                        class="w-full sm:w-auto text-center px-4 py-3 font-medium text-gray-600 hover:text-blue-600 border-b-2 border-transparent focus:outline-none transition">
                        Laporan Keuangan Terkini
                    </button>
                    <!-- Tab Button 2 -->
                    <button 
                        onclick="showPage('page-2')" 
                        id="btn-page-2" 
                        class="w-full sm:w-auto text-center px-4 py-3 font-medium text-gray-600 hover:text-blue-600 border-b-2 border-transparent focus:outline-none transition">
                        Informasi
                    </button>
                </div>

                <!-- Tab Content -->
                <div id="page-1" class="p-6 hidden">
                    <h3 class="font-semibold text-lg mb-4">Laporan Keuangan Terkini</h3>
                    <p>Konten untuk Sub-Halaman 1 masih kosong. Ini tampilan bulan terbaru dari keuangan, misalnya bulan Januari berarti laporan bulan Desember.</p>
                </div>

                <div id="page-2" class="p-6 hidden">
                    <h3 class="font-semibold text-lg mb-4">Pengumuman</h3>
                    <!-- Success Notification -->
                    @if (session('success'))
                        <div class="mb-4 bg-green-500 text-white px-4 py-2 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Add Pengumuman Button -->
                    @if (Auth::user()->role !== 'user')
                        <div class="mb-4 text-right">
                            <a href="{{ route('pengumuman.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">
                                + Pengumuman
                            </a>
                        </div>
                    @endif

                    <!-- Pengumuman Cards -->
                    <div class="space-y-6">
                        @forelse ($pengumuman as $item)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
                                <h4 class="text-lg font-bold text-gray-700 mb-2">{{ $item->judul }}</h4>
                                <p class="text-sm text-gray-600">{!! $item->isi !!}</p>
                                <p class="text-xs text-gray-500 mt-4">Tanggal: {{ $item->created_at->format('d M Y') }}</p>
                                
                                @if (Auth::user()->role !== 'user')
                                    <div class="mt-4 flex justify-end gap-2">
                                        <!-- Edit Button -->
                                        <a href="{{ route('pengumuman.edit', $item->id) }}" 
                                           class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 text-sm">
                                            Edit
                                        </a>
                                        <!-- Delete Button -->
                                        <form action="{{ route('pengumuman.destroy', $item->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 text-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-500 text-center">Tidak ada pengumuman yang tersedia.</p>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $pengumuman->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Switching Script -->
    <script>
        function showPage(pageId) {
            const pages = ['page-1', 'page-2'];
            const buttons = ['btn-page-1', 'btn-page-2'];
            pages.forEach((id, index) => {
                const page = document.getElementById(id);
                const button = document.getElementById(buttons[index]);
                if (id === pageId) {
                    page.classList.remove('hidden');
                    button.classList.add('border-blue-600', 'text-blue-600');
                    button.classList.remove('text-gray-600', 'border-transparent');
                } else {
                    page.classList.add('hidden');
                    button.classList.remove('border-blue-600', 'text-blue-600');
                    button.classList.add('text-gray-600', 'border-transparent');
                }
            });
        }
        showPage('page-2'); // Default to "Informasi" tab
    </script>
</x-app-layout>
