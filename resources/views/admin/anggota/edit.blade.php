<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('anggota.update', $anggota) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nama" class="block font-medium text-sm text-gray-700">Nama</label>
                            <input type="text" name="nama" id="nama" value="{{ $anggota->nama }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('nama')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="jenis_kelamin" class="block font-medium text-sm text-gray-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="L" {{ $anggota->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $anggota->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_lahir" class="block font-medium text-sm text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ $anggota->tanggal_lahir }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('tanggal_lahir')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="umur" class="block font-medium text-sm text-gray-700">Umur</label>
                            <input type="number" name="umur" id="umur" value="{{ $anggota->umur }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('umur')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status_anggota" class="block font-medium text-sm text-gray-700">Status Anggota</label>
                            <input type="text" name="status_anggota" id="status_anggota" value="{{ $anggota->status_anggota }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('status_anggota')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="kategori" class="block font-medium text-sm text-gray-700">Kategori</label>
                            <input type="text" name="kategori" id="kategori" value="{{ $anggota->kategori }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('kategori')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="kelompok_doa" class="block font-medium text-sm text-gray-700">Kelompok Doa</label>
                            <input type="text" name="kelompok_doa" id="kelompok_doa" value="{{ $anggota->kelompok_doa }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('kelompok_doa')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="pendidikan_terakhir" class="block font-medium text-sm text-gray-700">Pendidikan Terakhir</label>
                            <select name="pendidikan_terakhir" id="pendidikan_terakhir" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                <option value="SD" {{ $anggota->pendidikan_terakhir == 'SD' ? 'selected' : '' }}>Sekolah Dasar</option>
                                <option value="SMP" {{ $anggota->pendidikan_terakhir == 'SMP' ? 'selected' : '' }}>Sekolah Menengah Pertama</option>
                                <option value="SMA" {{ $anggota->pendidikan_terakhir == 'SMA' ? 'selected' : '' }}>Sekolah Menengah Atas</option>
                                <option value="D1" {{ $anggota->pendidikan_terakhir == 'D1' ? 'selected' : '' }}>Diploma 1</option>
                                <option value="D2" {{ $anggota->pendidikan_terakhir == 'D2' ? 'selected' : '' }}>Diploma 2</option>
                                <option value="D3" {{ $anggota->pendidikan_terakhir == 'D3' ? 'selected' : '' }}>Diploma 3</option>
                                <option value="D4" {{ $anggota->pendidikan_terakhir == 'D4' ? 'selected' : '' }}>Diploma 4</option>
                                <option value="S1" {{ $anggota->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>Sarjana</option>
                                <option value="S2" {{ $anggota->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>Magister</option>
                                <option value="S3" {{ $anggota->pendidikan_terakhir == 'S3' ? 'selected' : '' }}>Doktor</option>
                            </select>
                            @error('pendidikan_terakhir')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="pekerjaan" class="block font-medium text-sm text-gray-700">Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="pekerjaan" value="{{ $anggota->pekerjaan }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('pekerjaan')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="jabatan" class="block font-medium text-sm text-gray-700">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" value="{{ $anggota->jabatan }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('jabatan')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="id_gereja" class="block font-medium text-sm text-gray-700">Gereja</label>
                            <select name="id_gereja" id="id_gereja" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @foreach($gereja as $g)
                                    <option value="{{ $g->id }}" {{ $anggota->id_gereja == $g->id ? 'selected' : '' }}>{{ $g->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_gereja')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
