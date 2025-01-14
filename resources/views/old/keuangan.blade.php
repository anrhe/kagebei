<title>KGBI-ADM</title>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Keanggotaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (Auth::check()) 
                    <div class="text-gray-600">{{ Auth::user()->gereja->nama }} | {{ Auth::user()->name }} | {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY')}}</div>
                    @else
                    {{ __("Anda tidak terhubung akun!") }}
                    @endif 
                </div>
            </div>
            {{-- Filter Form --}}
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 text-gray-900 font">
                    <div class="text-bold text-center font-extrabold text-2xl py-3">Daftar Keanggotaan</div>
                       {{-- tabel  --}}
                    <div class="overflow-x-auto mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <table class="min-w-full border-collapse border border-gray-200">
                    </div>                         
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
