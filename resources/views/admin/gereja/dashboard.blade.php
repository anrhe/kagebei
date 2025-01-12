<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hallo, ') }} {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Gereja Info Section -->
                    <div class="mb-6">
                        <div class="mb-6 flex justify-between items-center">
                            <h3 class="text-bold font-extrabold text-2xl py-3">Informasi Gereja</h3>
                            @if (Auth::user()->role !== 'operator')
                                <a href="{{ route('laporan.summary') }}" class="text-white bg-green-500 rounded-lg hover:bg-green-700 px-3 py-2 mt-3 inline-block">
                                    Lihat Laporan Keuangan
                                </a>
                            @endif
                        </div>
                        <p class="text-sm sm:text-base"><strong>Nama :</strong> {{ $gereja->nama }}</p>
                        <p class="text-sm sm:text-base"><strong>Alamat :</strong> {{ $gereja->alamat }}</p>
                        <p class="text-sm sm:text-base"><strong>Kontak :</strong> {{ $gereja->kontak }}</p>
                        @if (Auth::user()->role !== 'user')
                            <a href="{{ route('gereja.edit', $gereja->id) }}" class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 px-3 py-2 mt-3 inline-block">
                                Edit Informasi Gereja
                            </a>
                        @endif
                    </div>

                    <!-- Anggota Section -->
                    <h3 class="text-bold text-center font-extrabold text-2xl py-3">
                        Daftar Anggota 
                        @if (Auth::user()->role !== 'user')
                            <a href="{{ route('anggota.create') }}" class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 mx-6 px-1">+</a>
                        @endif
                    </h3>
                    <table class="table-auto w-full border border-black mb-6">
                        <thead>
                            <tr>
                                <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Nama</th>
                                <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Jenis kelamin</th>
                                <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Tanggal lahir</th>
                                <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Kelompok doa</th>
                                <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Pekerjaan</th>
                                <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Jabatan</th>
                                <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Kategori</th>
                                @if (Auth::user()->role !== 'user')
                                    <th colspan="2" class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keanggotaan as $anggota)
                                <tr>
                                    <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->nama }}</td>
                                    <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->jenis_kelamin }}</td>
                                    <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->tanggal_lahir }}</td>
                                    <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->kelompok_doa }}</td>
                                    <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->pekerjaan }}</td>
                                    <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->jabatan }}</td>
                                    <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->kategori }}</td>
                                    @if (Auth::user()->role !== 'user')
                                        <td class="px-2 sm:px-4 py-2 border border-gray-200">
                                            <a href="{{ route('anggota.edit', $anggota->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                        </td>
                                        <td class="px-2 sm:px-4 py-2 border border-gray-200">
                                            <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links for Anggota -->
                    <div class="mt-4">
                        {{ $keanggotaan->links() }}
                    </div>

                    <!-- Laporan Section -->
                    @if (Auth::user()->role == 'operator')

                        <h3 class="text-bold text-center font-extrabold text-2xl py-3">
                            Daftar Transaksi 
                            <a href="{{ route('laporan.create') }}" class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 mx-6 px-1">+</a>
                        </h3>
                        <a href="{{ route('laporan.summary') }}" class="text-white bg-green-500 rounded-lg hover:bg-green-700 px-4 py-2">Lihat Ringkasan</a>
                        <table class="table-auto w-full border border-black mb-6">
                            <thead>
                                <tr>
                                    <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Nama</th>
                                    <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Tipe</th>
                                    <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Nominal</th>
                                    <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Tanggal</th>
                                    <th colspan="2" class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporan as $item)
                                    <tr>
                                        <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $item->nama }}</td>
                                        <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ ucwords($item->tipe) }}</td>
                                        <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">Rp. {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                        <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $item->tanggal }}</td>
                                        <td class="px-2 sm:px-4 py-2 border border-gray-200">
                                            <a href="{{ route('laporan.edit', $item->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                        </td>
                                        <td class="px-2 sm:px-4 py-2 border border-gray-200">
                                            <form action="{{ route('laporan.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination Links for Laporan -->
                        <div class="mt-4">
                            {{ $laporan->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
