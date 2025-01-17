<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <!-- Filters Section -->
                    <div class="mb-6 bg-gray-100 p-4 rounded-lg flex flex-wrap items-center gap-4">
                        <!-- Dropdown Tahun -->
                        <div class="w-full sm:w-auto">
                            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                            <select id="year" name="year" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                onchange="location.href='?year=' + this.value">
                                <option value="">Pilih Tahun</option>
                                @foreach ($availableYears as $year)
                                    <option value="{{ $year->year }}" {{ $selectedYear == $year->year ? 'selected' : '' }}>
                                        {{ $year->year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dropdown Bulan -->
                        <div class="w-full sm:w-auto">
                            <label for="month" class="block text-sm font-medium text-gray-700">Bulan</label>
                            <select id="month" name="month" 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md"
                                onchange="location.href='?year={{ $selectedYear }}&month=' + this.value">
                                <option value="">Pilih Bulan</option>
                                @foreach ($availableMonths as $month)
                                    <option value="{{ $month->month }}" {{ $selectedMonth == $month->month ? 'selected' : '' }}>
                                        {{ $month->month_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dropdown Minggu -->
                        <div class="w-full sm:w-auto">
                            <label for="week" class="block text-sm font-medium text-gray-700">Minggu</label>
                            <select id="week" name="week" 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md"
                                onchange="location.href='?year={{ $selectedYear }}&month={{ $selectedMonth }}&week=' + this.value">
                                <option value="">Pilih Minggu</option>
                                @foreach ($availableWeeks as $week)
                                    <option value="{{ $week->week }}" {{ $selectedWeek == $week->week ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::parse($week->start_date)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($week->end_date)->translatedFormat('d F Y') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tambah Transaksi Button -->
                        @if (Auth::user()->role == 'operator')
                        <div class="ml-auto">
                            <a href="{{ route('laporan.create') }}" 
                                class="inline-block text-white bg-blue-500 hover:bg-blue-700 px-6 py-2 rounded-lg shadow-md focus:outline-none transition duration-200 whitespace-nowrap">
                                    + Transaksi
                            </a>
                        </div>
                        @endif
                    </div>

                    <!-- Transaction Summary Section -->
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

                    <div class="mb-6">
                        <h4 class="font-extrabold text-lg mb-4">Grafik Pemasukan dan Pengeluaran</h4>
                        <canvas id="incomeExpenseChart" height="100"></canvas>
                    </div>
                    
                    
                   <!-- Section untuk Detail Pemasukan dan Pengeluaran -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Tabel Pemasukan -->
    <div class="bg-white p-4 rounded-lg shadow">
        <h4 class="font-extrabold text-lg mb-4">Detail Pemasukan</h4>
        <table class="table-auto w-full border border-gray-200 text-sm">
            <thead>
                <tr>
                    <th class="px-4 py-2 border bg-gray-100">Nama</th>
                    <th class="px-4 py-2 border bg-gray-100">Nominal</th>
                    <th class="px-4 py-2 border bg-gray-100">Tanggal</th>
                    @if (Auth::user()->role == 'operator')
                        <th class="px-4 py-2 border bg-gray-100">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($incomeTransactions as $transaction)
                    <tr>
                        <td class="px-4 py-2 border">{{ $transaction->nama }}</td>
                        <td class="px-4 py-2 border">Rp. {{ number_format($transaction->nominal, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border">{{ $transaction->tanggal }}</td>
                        @if (Auth::user()->role == 'operator')
                            <td class="px-4 py-2 border text-center">
                                <div class="flex justify-center gap-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('laporan.edit', $transaction->id) }}" 
                                       class="flex items-center bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded-md shadow-sm text-sm">
                                        Edit
                                    </a>
                                    <!-- Delete Button -->
                                    <form action="{{ route('laporan.destroy', $transaction->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')" 
                                                class="flex items-center bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md shadow-sm text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center px-4 py-2 border">Tidak ada pemasukan untuk periode ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tabel Pengeluaran -->
    <div class="bg-white p-4 rounded-lg shadow">
        <h4 class="font-extrabold text-lg mb-4">Detail Pengeluaran</h4>
        <table class="table-auto w-full border border-gray-200 text-sm">
            <thead>
                <tr>
                    <th class="px-4 py-2 border bg-gray-100">Nama</th>
                    <th class="px-4 py-2 border bg-gray-100">Nominal</th>
                    <th class="px-4 py-2 border bg-gray-100">Tanggal</th>
                    @if (Auth::user()->role == 'operator')
                        <th class="px-4 py-2 border bg-gray-100">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($expenseTransactions as $transaction)
                    <tr>
                        <td class="px-4 py-2 border">{{ $transaction->nama }}</td>
                        <td class="px-4 py-2 border">Rp. {{ number_format($transaction->nominal, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border">{{ $transaction->tanggal }}</td>
                        @if (Auth::user()->role == 'operator')
                            <td class="px-4 py-2 border text-center">
                                <div class="flex justify-center gap-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('laporan.edit', $transaction->id) }}" 
                                       class="flex items-center bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded-md shadow-sm text-sm">
                                        Edit
                                    </a>
                                    <!-- Delete Button -->
                                    <form action="{{ route('laporan.destroy', $transaction->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')" 
                                                class="flex items-center bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md shadow-sm text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center px-4 py-2 border">Tidak ada pengeluaran untuk periode ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
            </div>
        </div>
    </div>
    
</x-app-layout>
