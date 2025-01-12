<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <!-- Back Button -->
            <a href="{{ url('/beranda') }}" 
                class="text-gray-800 hover:text-gray-600 transition duration-200 flex items-center focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="font-medium">{{ __('Kembali') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Gereja Info Section -->
                    <div class="mb-6">
                        <div class="mb-6 flex justify-between items-center">
                            <h3 class="text-bold font-extrabold text-2xl py-3">Informasi Gereja</h3>
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
                    
                    <!-- Filtering Form -->
                    <form action="{{ route('admin.gereja.dashboard') }}" method="GET" class="mb-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Kategori -->
                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                                <select name="kategori" id="kategori" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm">
                                    <option value="">Semua</option>
                                    @foreach ($allKategori as $kategori)
                                        <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                                            {{ $kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kelompok Doa -->
                            <div>
                                <label for="kelompok_doa" class="block text-sm font-medium text-gray-700">Kelompok Doa</label>
                                <select name="kelompok_doa" id="kelompok_doa" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm">
                                    <option value="">Semua</option>
                                    @foreach ($allKelompokDoa as $kelompok)
                                        <option value="{{ $kelompok }}" {{ request('kelompok_doa') == $kelompok ? 'selected' : '' }}>
                                            {{ $kelompok }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status Anggota -->
                            <div>
                                <label for="status_anggota" class="block text-sm font-medium text-gray-700">Status Anggota</label>
                                <select name="status_anggota" id="status_anggota" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm">
                                    <option value="">Semua</option>
                                    @foreach ($allStatusAnggota as $status)
                                        <option value="{{ $status }}" {{ request('status_anggota') == $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm">
                                    <option value="">Semua</option>
                                    <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <!-- Umur Min -->
                            <div>
                                <label for="umur_min" class="block text-sm font-medium text-gray-700">Umur Min</label>
                                <input type="number" name="umur_min" id="umur_min" value="{{ request('umur_min') }}" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm">
                            </div>

                            <!-- Umur Max -->
                            <div>
                                <label for="umur_max" class="block text-sm font-medium text-gray-700">Umur Max</label>
                                <input type="number" name="umur_max" id="umur_max" value="{{ request('umur_max') }}" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                                Filter
                            </button>
                            <a href="{{ route('admin.gereja.dashboard') }}" class="ml-2 text-gray-700 hover:underline">
                                Reset
                            </a>
                        </div>
                    </form>


                    <!-- Anggota Section -->
                    <h3 class="text-bold text-center font-extrabold text-2xl py-3">
                        Daftar Anggota 
                        @if (Auth::user()->role !== 'user')
                            <a href="{{ route('anggota.create') }}" class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 mx-6 px-1">+</a>
                        @endif
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border border-black mb-6">
                            <thead>
                                <tr>
                                    <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Nama</th>
                                    <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Jenis kelamin</th>
                                    <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Tanggal lahir</th>
                                    <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Umur</th>
                                    <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Pendidikan terakhir</th>
                                    <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Pekerjaan</th>
                                    <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Status anggota</th>
                                    <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Kategori</th>
                                    <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Kelompok doa</th>
                                    <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Jabatan</th>
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
                                        <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->umur }}</td>
                                        <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->pendidikan_terakhir }}</td>
                                        <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->pekerjaan }}</td>
                                        <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->status_anggota }}</td>
                                        <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->kategori }}</td>
                                        <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->kelompok_doa }}</td>
                                        <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->jabatan }}</td>
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
                    </div>

                    <!-- Pagination Links for Anggota -->
                    <div class="mt-4">
                        {{ $keanggotaan->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
