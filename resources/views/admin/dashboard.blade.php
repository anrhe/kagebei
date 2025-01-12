<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <!-- Back Button -->
            <a href="{{ url('/beranda') }}" 
               class="text-gray-800 hover:text-gray-600 transition duration-200 flex items-center">
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

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-bold font-extrabold text-2xl">Daftar Gereja</h3>
                        <a href="{{ route('gereja.create') }}" class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 px-4 py-2">
                            Tambah Gereja +
                        </a>
                    </div>

                    @foreach ($gerejas as $gereja)
                        <div class="m-8 p-4 border border-gray-300 rounded-lg bg-gray-50">
                            <div class="mb-4">
                                <h4 class="text-bold font-extrabold text-lg py-2">Informasi Gereja</h4>
                                <p class="text-sm sm:text-base"><strong>Nama :</strong> {{ $gereja->nama }}</p>
                                <p class="text-sm sm:text-base"><strong>Alamat :</strong> {{ $gereja->alamat }}</p>
                                <p class="text-sm sm:text-base"><strong>Kontak :</strong> {{ $gereja->kontak }}</p>
                                <div class="flex gap-3 mt-3">
                                    <a href="{{ route('gereja.edit', $gereja->id) }}" class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 px-3 py-2">
                                        Edit Informasi Gereja
                                    </a>
                                    @if (auth()->user()->id_gereja !== $gereja->id) <!-- Check if the church is not associated with the logged-in user -->
                                        <form action="{{ route('gereja.destroy', $gereja->id) }}" method="POST" 
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus gereja ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-500 text-white rounded-lg hover:bg-red-700 px-3 py-2">
                                                Hapus Gereja
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <h4 class="text-bold font-extrabold text-lg py-2">Daftar Pengguna</h4>
                                <table class="table-auto w-full border border-gray-300">
                                    <thead>
                                        <tr>
                                            <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Nama</th>
                                            <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Email</th>
                                            <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Role</th>
                                            <th colspan="2" class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($gereja->pengguna as $user)
                                            <tr>
                                                <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $user->name }}</td>
                                                <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $user->email }}</td>
                                                <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $user->role }}</td>
                                                @if (auth()->user()->id !== $user->id) <!-- Check if the logged-in user is not the same as the user in the list -->
                                                    <td class="px-2 sm:px-4 py-2 border border-gray-200">
                                                        <a href="{{ route('pengguna.edit', $user->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                                    </td>
                                                    <td class="px-2 sm:px-4 py-2 border border-gray-200">
                                                        <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                                        </form>
                                                    </td>
                                                @else
                                                    <td colspan="2" class="text-center px-2 sm:px-4 py-2 border border-gray-200">
                                                        <a href="{{ route('pengguna.edit', $user->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-sm text-center py-4 sm:text-base text-gray-500">Belum ada pengguna untuk gereja ini.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    <a href="{{ route('pengguna.create', ['id_gereja' => $gereja->id]) }}" class="text-white bg-green-500 rounded-lg hover:bg-green-700 px-3 py-2">
                                        Tambah Pengguna
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
