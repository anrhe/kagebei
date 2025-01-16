<x-app-layout>
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
                <div id="page-1" class="p-6">
                    <div class="flex justify-between items-center">
                        <!-- Title -->
                        <h3 class="font-semibold text-lg">Laporan Keuangan Terkini</h3>
                
                        <!-- Download Button -->
                        <a href="{{ route('laporan.pdf') }}" 
                           class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 transition">
                            Download PDF
                        </a>
                    </div>
                
                    <!-- Totals -->
                    <div class="flex justify-between mt-4">
                        <div>
                            <h4 class="text-lg font-bold">Total</h4>
                        </div>
                        <div class="text-right">
                            <p class="text-green-600 font-bold">Pemasukan: Rp. {{ number_format($totalPemasukan, 2, ',', '.') }}</p>
                            <p class="text-red-600 font-bold">Pengeluaran: Rp. {{ number_format($totalPengeluaran, 2, ',', '.') }}</p>
                            <p class="text-blue-600 font-bold">Saldo: Rp. {{ number_format($saldo, 2, ',', '.') }}</p>
                        </div>
                    </div>

                    <!-- Transactions Section -->
                    <div class="flex flex-wrap gap-6">
                        <!-- Pemasukan Table -->
                        <div class="w-full md:w-1/2">
                            <h4 class="font-bold text-lg mb-4">Pemasukan</h4>
                            <table class="table-auto w-full border-collapse border border-gray-200 text-xs sm:text-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border px-4 py-2">Nama</th>
                                        <th class="border px-4 py-2">Nominal</th>
                                        <th class="border px-4 py-2">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pemasukan as $item)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $item->nama }}</td>
                                            <td class="border px-4 py-2">Rp. {{ number_format($item->nominal, 2, ',', '.') }}</td>
                                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="border px-4 py-2 text-center">Tidak ada transaksi pemasukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pengeluaran Table -->
                        <div class="w-full md:w-1/2">
                            <h4 class="font-bold text-lg mb-4">Pengeluaran</h4>
                            <table class="table-auto w-full border-collapse border border-gray-200 text-xs sm:text-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border px-4 py-2">Nama</th>
                                        <th class="border px-4 py-2">Nominal</th>
                                        <th class="border px-4 py-2">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pengeluaran as $item)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $item->nama }}</td>
                                            <td class="border px-4 py-2">Rp. {{ number_format($item->nominal, 2, ',', '.') }}</td>
                                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="border px-4 py-2 text-center">Tidak ada transaksi pengeluaran</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="page-2" class="p-6 hidden">
                    <h3 class="font-semibold text-lg mb-4">Pengumuman</h3>
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
        showPage('page-1'); // Default to "Laporan Keuangan Terkini" tab
    </script>
</x-app-layout>