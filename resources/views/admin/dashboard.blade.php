<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Gereja Section -->
                    <h3 class="text-bold text-center font-extrabold text-2xl py-3">
                        Daftar Gereja
                        <a href="{{ route('gereja.create') }}" class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 mx-6 px-1">+</a> 
                    </h3>
                    <table class="table-auto w-full border border-gray-300">
                        <thead>
                            <tr>
                                <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Nama Gereja</th>
                                <th colspan="2" class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gerejas as $gereja)
                                <tr>
                                    <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $gereja->nama }}</td>
                                    <td class="px-2 sm:px-4 py-2 border border-gray-200">
                                        <a href="{{ route('gereja.edit', $gereja->id) }}" class="text-blue-500 hover:underline">Edit</a> 
                                    </td>
                                    <td class="px-2 sm:px-4 py-2 border border-gray-200">
                                        <form action="{{ route('gereja.destroy', $gereja->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pengguna Section -->
                    <h3 class="text-bold text-center font-extrabold text-2xl py-3">
                        Daftar Pengguna 
                        <a href="{{ route('pengguna.create') }}" class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 mx-6 px-1">+</a>
                    </h3>
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
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $user->name }}</td>
                                    <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $user->email }}</td>
                                    <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $user->role }}</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Anggota Section -->
                    <h3 class="text-bold text-center font-extrabold text-2xl py-3">
                        Daftar Anggota 
                        <a href="{{ route('anggota.create') }}" class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 mx-6 px-1">+</a>
                    </h3>
                    <table class="table-auto w-full border border-black">
                        <thead>
                            <tr>
                                <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Nama</th>
                                <th class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Gereja</th>
                                <th colspan="2" class="px-2 sm:px-4 py-2 border border-gray-200 bg-gray-200 text-xs sm:text-base">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keanggotaan as $anggota)
                                <tr>
                                    <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->nama }}</td>
                                    <td class="px-2 sm:px-4 py-2 border border-gray-200 text-xs sm:text-base">{{ $anggota->gereja->nama }}</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
