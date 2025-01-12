<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <button onclick="window.history.back();" class="mb-4 text-white bg-gray-500 hover:bg-gray-700 rounded-lg px-4 py-2">
                        Kembali
                    </button>
                    
                    <form action="{{ route('laporan.update', $laporan) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nama" class="block font-medium text-sm text-gray-700">Nama</label>
                            <input type="text" name="nama" id="nama" value="{{ $laporan->nama }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('nama')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tipe" class="block font-medium text-sm text-gray-700">Tipe</label>
                            <select name="tipe" id="tipe" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                <option value="pemasukan" {{ $laporan->tipe === 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                <option value="pengeluaran" {{ $laporan->tipe === 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                            @error('tipe')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="nominal" class="block font-medium text-sm text-gray-700">Nominal</label>
                            <input type="number" name="nominal" id="nominal" value="{{ $laporan->nominal }}" step="0.01" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('nominal')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="created_at" class="block font-medium text-sm text-gray-700">Tanggal Transaksi</label>
                            <input type="date" name="created_at" id="created_at" value="{{ $laporan->created_at->format('Y-m-d') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('created_at')
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
