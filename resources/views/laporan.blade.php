<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengumuman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Notification for Success -->
                    @if (session('success'))
                        <div class="mb-4 bg-green-500 text-white px-4 py-2 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Add Pengumuman Button -->
                    @if (Auth::user()->role !== 'user')
                        <div class="mb-4 text-right">
                            <a href="{{ route('pengumuman.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Tambah Pengumuman
                            </a>
                        </div>
                    @endif

                    <!-- Pengumuman List -->
                    <table class="table-auto w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2 text-left">Judul</th>
                                <th class="border px-4 py-2 text-left">Isi</th>
                                <th class="border px-4 py-2 text-left">Tanggal</th>
                                @if (Auth::user()->role !== 'user')
                                    <th class="border px-4 py-2 text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengumuman as $item)
                                <tr>
                                    <td class="border px-4 py-2">{{ $item->judul }}</td>
                                    <td class="border px-4 py-2">{{ Str::limit($item->isi, 50) }}</td>
                                    <td class="border px-4 py-2">{{ $item->created_at->format('d M Y') }}</td>
                                    @if (Auth::user()->role !== 'user')
                                        <td class="border px-4 py-2 text-center">
                                            <!-- Edit Button -->
                                            <a href="{{ route('pengumuman.edit', $item->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                                                Edit
                                            </a>
                                            <!-- Delete Button -->
                                            <form action="{{ route('pengumuman.destroy', $item->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ Auth::user()->role !== 'user' ? '4' : '3' }}" class="border px-4 py-2 text-center">
                                        Tidak ada pengumuman yang tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $pengumuman->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
