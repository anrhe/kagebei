<x-app-layout>
     <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Gereja Info Section -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center">
                            <!-- Header Informasi Gereja -->
                            <h3 class="text-bold font-extrabold text-2xl py-3">Informasi Gereja</h3>
                    
                            <!-- Tombol Edit Informasi dan Kategorisasi -->
                            <div class="flex items-center space-x-2">
                                @if (Auth::user()->role !== 'user')
                                    <!-- Tombol Edit Informasi Gereja -->
                                    <a href="{{ route('gereja.edit', $gereja->id) }}" 
                                       class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 px-3 py-2">
                                        Edit Informasi Gereja
                                    </a>
                    
                                    <!-- Tombol Kategorisasi -->
                                    <button 
                                        class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 px-3 py-2" 
                                        onclick="toggleFilterSection()">
                                        Kategorisasi
                                    </button>
                                @endif
                            </div>
                        </div>
                    
                        <!-- Informasi Gereja -->
                        <p class="text-sm sm:text-base"><strong>Nama :</strong> {{ $gereja->nama }}</p>
                        <p class="text-sm sm:text-base"><strong>Alamat :</strong> {{ $gereja->alamat }}</p>
                        <p class="text-sm sm:text-base"><strong>Kontak :</strong> {{ $gereja->kontak }}</p>
                    </div>
                    
                    <!-- Filtering Form -->
                    <div id="filter-section" class="hidden bg-white px-4 py-4 rounded-lg border border-gray-300">
                        <form action="{{ route('admin.gereja.dashboard') }}" method="GET">
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
                    </div>
                    
                    <!-- Tambahkan Script -->
                    <script>
                        function toggleFilterSection() {
                            const section = document.getElementById('filter-section');
                            section.classList.toggle('hidden');
                        }
                    </script>
                    
                    <!-- Anggota Section -->
                    <h3 class="text-bold text-center font-extrabold text-2xl py-3">
                        Daftar Anggota 
                        @if (Auth::user()->role !== 'user')
                            <a href="{{ route('anggota.create') }}" class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 mx-6 px-1">+</a>
                        @endif
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border border-gray-300 mb-4 text-xs sm:text-sm">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-2 py-1 border border-gray-300 text-left">Nama</th>
                                    <th class="px-2 py-1 border border-gray-300 text-left">Jenis Kelamin</th>
                                    <th class="px-2 py-1 border border-gray-300 text-left">Tanggal Lahir</th>
                                    <th class="px-2 py-1 border border-gray-300 text-left">Umur</th>
                                    <th class="px-2 py-1 border border-gray-300 text-left">Pendidikan</th>
                                    <th class="px-2 py-1 border border-gray-300 text-left">Pekerjaan</th>
                                    <th class="px-2 py-1 border border-gray-300 text-left">Status</th>
                                    <th class="px-2 py-1 border border-gray-300 text-left">Kategori</th>
                                    <th class="px-2 py-1 border border-gray-300 text-left">Kelompok Doa</th>
                                    <th class="px-2 py-1 border border-gray-300 text-left">Jabatan</th>
                                    @if (Auth::user()->role !== 'user')
                                        <th colspan="2" class="px-2 py-1 border border-gray-300 text-left">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($keanggotaan as $anggota)
                                    <tr>
                                        <td class="px-2 py-1 border border-gray-300">{{ $anggota->nama }}</td>
                                        <td class="px-2 py-1 border border-gray-300">{{ $anggota->jenis_kelamin }}</td>
                                        <td class="px-2 py-1 border border-gray-300">{{ $anggota->tanggal_lahir }}</td>
                                        <td class="px-2 py-1 border border-gray-300">{{ $anggota->umur }}</td>
                                        <td class="px-2 py-1 border border-gray-300">{{ $anggota->pendidikan_terakhir }}</td>
                                        <td class="px-2 py-1 border border-gray-300">{{ $anggota->pekerjaan }}</td>
                                        <td class="px-2 py-1 border border-gray-300">{{ $anggota->status_anggota }}</td>
                                        <td class="px-2 py-1 border border-gray-300">{{ $anggota->kategori }}</td>
                                        <td class="px-2 py-1 border border-gray-300">{{ $anggota->kelompok_doa }}</td>
                                        <td class="px-2 py-1 border border-gray-300">{{ $anggota->jabatan }}</td>
                                        @if (Auth::user()->role !== 'user')
                                            <td class="px-2 py-1 border border-gray-300">
                                                <a href="{{ route('anggota.edit', $anggota->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                            </td>
                                            <td class="px-2 py-1 border border-gray-300">
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
