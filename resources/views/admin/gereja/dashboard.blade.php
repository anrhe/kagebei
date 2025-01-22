<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Notifications Section -->
                    @if (session('success') || session('error'))
                    <div id="notification" 
                        class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 max-w-lg px-4 py-3 rounded-lg shadow-lg flex items-center space-x-3 transition duration-500 ease-in-out"
                        style="background-color: {{ session('success') ? '#D1FAE5' : '#FEE2E2' }}; color: {{ session('success') ? '#065F46' : '#991B1B' }}">
                        <div class="flex-shrink-0">
                            @if (session('success'))
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-medium">
                                @if (session('success'))
                                    <span>Sukses!</span> {{ session('success') }}
                                @else
                                    <span>Error!</span> {{ session('error') }}
                                @endif
                            </p>
                        </div>
                        <button id="close-notification" class="ml-auto text-gray-500 hover:text-gray-800 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    @endif

                    <!-- JavaScript to Handle Notification -->
                    <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const notification = document.getElementById('notification');
                        const closeNotification = document.getElementById('close-notification');

                        if (notification) {
                            // Automatically hide notification after 5 seconds
                            setTimeout(() => {
                                notification.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                                setTimeout(() => {
                                    notification.remove();
                                }, 500); // Match the duration of the fade-out effect
                            }, 5000);

                            // Allow user to manually close the notification
                            closeNotification.addEventListener('click', () => {
                                notification.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                                setTimeout(() => {
                                    notification.remove();
                                }, 500); // Match the duration of the fade-out effect
                            });
                        }
                    });
                    </script>

                    <!-- Gereja Info Section -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center">
                            <h3 class="text-bold font-extrabold text-2xl py-3 underline">Informasi Gereja</h3>
                            <div class="flex items-center space-x-2 gap-2">
                                    @if (Auth::user()->role !== 'user')
                                    <a href="{{ route('gereja.edit', $gereja->id) }}"
                                        class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 px-3 py-2">
                                        Edit Informasi Gereja
                                    </a>
                                    @endif
                                    <button class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 px-3 py-2"
                                        onclick="toggleFilterSection()">
                                        Kategorisasi
                                    </button>
                                </div>
                        </div>

                        <!-- Gereja Details -->
                        <p class="text-sm sm:text-base"><strong>Tempat :</strong> {{ $gereja->nama }}</p>
                        <p class="text-sm sm:text-base"><strong>Alamat :</strong> {{ $gereja->alamat }}</p>
                        <p class="text-sm sm:text-base"><strong>Kontak :</strong> {{ $gereja->kontak }}</p>
                    </div>

                    <!-- Upload File Section -->
                    @if (Auth::user()->role !== 'user')
                        
                        <div class="mb-6">
                            <div class="bg-blue-50 border border-blue-300 rounded-lg p-4 shadow-sm">
                                <h3 class="text-lg font-semibold text-blueI9 YUU   -700 mb-2">Upload File Anggota</h3>
                                <p class="text-sm text-gray-700 mb-4">
                                    Unggah file CSV atau Excel untuk menambahkan data jemaat ke
                                    <span class="font-semibold">Gereja Anda</span>. Pastikan format kolom dalam file
                                    sesuai dengan data jemaat yang diminta.
                                </p>
                                <form action="{{ route('anggota.import') }}" method="POST" enctype="multipart/form-data"
                                    class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="file"
                                            class="block text-sm font-medium text-gray-700 mb-1">Pilih File</label>
                                        <input type="file" name="file" id="file" accept=".csv, .xlsx"
                                            class="block w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                                            <!-- Display validation error -->
                                            @error('file')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                    </div>
                                    <div class="flex items-center justify-between py-2">
                                        <button type="submit"
                                            class="text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-lg px-5 py-2 text-sm font-medium shadow-md">
                                            Upload File
                                        </button>
                                        <p class="text-xs text-gray-500">Format file: .csv, .xlsx</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    <!-- Filtering Form -->
                    <div id="filter-section" class="hidden bg-white px-4 py-4 rounded-lg border border-gray-300">
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
                    </div>

                    <!-- Anggota Section -->
                    <h3 class="text-bold text-center font-extrabold text-2xl py-3">
                        Daftar Anggota
                        @if (Auth::user()->role !== 'user')
                            <a href="{{ route('anggota.create') }}"
                                class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 px-2 py-1">
                                +
                            </a>
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
                                                <a href="{{ route('anggota.edit', $anggota->id) }}"
                                                    class="text-blue-500 hover:underline">Edit</a>
                                            </td>
                                            <td class="px-2 py-1 border border-gray-300">
                                                <form action="{{ route('anggota.destroy', $anggota->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 hover:underline">Hapus</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $keanggotaan->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleFilterSection() {
            const section = document.getElementById('filter-section');
            section.classList.toggle('hidden');
        }
    </script>
</x-app-layout>