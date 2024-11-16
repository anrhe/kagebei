<div class="flex justify-end mb-4">
    <!-- Button with SVG Logo -->
    <button id="filterButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
        <span>Filter</span>
        <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-6.83 6.828a4 4 0 00-.707 4.95l-1.867 1.868a1 1 0 01-1.414 0L3.707 17.414a1 1 0 010-1.414L14.536 4.707A1 1 0 0115 4V4a1 1 0 01-1-1H4a1 1 0 01-1-1z"></path>
        </svg>
    </button>
</div>

<!-- Filter Form (Initially Hidden) -->
<div id="filterForm" class="hidden">
    <x-filter-keang>
        <form action="{{ route('keanggotaan') }}" method="GET" class="mt-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4"> 
                <select name="kategori" class="rounded-md">
                    <option value="">Semua Kategori</option>
                    @foreach ($allKategori as $kategori)
                        <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
                <select name="kelompok_doa" class="rounded-md">
                    <option value="">Semua Kelompok Doa</option>
                    @foreach ($allKelompokDoa as $kelompokDoa)
                        <option value="{{ $kelompokDoa }}" {{ request('kelompok_doa') == $kelompokDoa ? 'selected' : '' }}>
                            {{ $kelompokDoa }}
                        </option>
                    @endforeach
                </select>
                <select name="status_anggota" class="rounded-md">
                    <option value="">Semua Status Anggota</option>
                    @foreach ($allStatusAnggota as $statusAnggota)
                        <option value="{{ $statusAnggota }}" {{ request('status_anggota') == $statusAnggota ? 'selected' : '' }}>
                            {{ $statusAnggota }}
                        </option>
                    @endforeach
                </select>
                <select name="jenis_kelamin" class="rounded-md">
                    <option value="">Semua Jenis Kelamin</option>
                    <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-4"> 
                <div>
                    <label for="umur_min" class="block">Umur Minimal:</label>
                    <input type="number" name="umur_min" value="{{ request('umur_min') }}" class="rounded-md">
                </div>
                <div>
                    <label for="umur_max" class="block">Umur Maksimal:</label>
                    <input type="number" name="umur_max" value="{{ request('umur_max') }}" class="rounded-md">
                </div>
            </div>

            <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Filter
            </button>
        </form>
    </x-filter-keang>
</div>

<!-- JavaScript to Toggle Form Visibility -->
<script>
    document.getElementById('filterButton').addEventListener('click', function() {
        var filterForm = document.getElementById('filterForm');
        filterForm.classList.toggle('hidden');
    });
</script>
