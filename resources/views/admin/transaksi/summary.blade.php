<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ringkasan Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-bold font-extrabold text-2xl py-3">Laporan Keuangan Gereja</h3>

                    <!-- Month Filter -->
                    <form method="GET" action="{{ route('laporan.summary') }}" class="mb-6">
                        <label for="week" class="block text-gray-700 font-medium">Pilih Minggu:</label>
                        <select name="week" id="week" class="w-full sm:w-auto border-gray-300 rounded-md shadow-sm">
                            <option value="">Semua Minggu</option>
                            @foreach ($availableWeeks as $key => $week)
                                <option value="{{ $key }}" {{ request('week') == $key ? 'selected' : '' }}>
                                    {{ $week }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                            Lihat
                        </button>
                    </form>

                    <!-- Summary Section -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                        <div class="p-4 bg-green-100 border border-green-300 rounded-lg text-center">
                            <h4 class="font-extrabold text-xl text-green-700">Total Pemasukan</h4>
                            <p class="text-lg">Rp. {{ number_format($totalIncome, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-4 bg-red-100 border border-red-300 rounded-lg text-center">
                            <h4 class="font-extrabold text-xl text-red-700">Total Pengeluaran</h4>
                            <p class="text-lg">Rp. {{ number_format($totalExpense, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-4 bg-blue-100 border border-blue-300 rounded-lg text-center">
                            <h4 class="font-extrabold text-xl text-blue-700">Saldo Akhir</h4>
                            <p class="text-lg">Rp. {{ number_format($balance, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <!-- Income Transactions Table -->
                    <h4 class="font-extrabold text-lg mb-4">Detail Pemasukan</h4>
                    <table class="table-auto w-full border border-gray-200 mb-6">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border bg-gray-100">Nama</th>
                                <th class="px-4 py-2 border bg-gray-100">Nominal</th>
                                <th class="px-4 py-2 border bg-gray-100">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($incomeTransactions as $transaction)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $transaction->nama }}</td>
                                    <td class="px-4 py-2 border">Rp. {{ number_format($transaction->nominal, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 border">{{ $transaction->tanggal }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center px-4 py-2 border">Tidak ada pemasukan untuk bulan ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Expense Transactions Table -->
                    <h4 class="font-extrabold text-lg mb-4">Detail Pengeluaran</h4>
                    <table class="table-auto w-full border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border bg-gray-100">Nama</th>
                                <th class="px-4 py-2 border bg-gray-100">Nominal</th>
                                <th class="px-4 py-2 border bg-gray-100">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($expenseTransactions as $transaction)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $transaction->nama }}</td>
                                    <td class="px-4 py-2 border">Rp. {{ number_format($transaction->nominal, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 border">{{ $transaction->tanggal }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center px-4 py-2 border">Tidak ada pengeluaran untuk bulan ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Back to Dashboard -->
                    <a href="{{ route('admin.gereja.dashboard') }}" class="text-white bg-blue-500 rounded-lg hover:bg-blue-700 px-3 py-2 mt-4 inline-block">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
