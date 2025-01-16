<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 0; }
        .container { max-width: 800px; margin: 0 auto; padding: 20px; }
        .title { text-align: center; margin-bottom: 20px; }
        .title h1 { font-size: 18px; margin: 0; }
        .title p { font-size: 14px; color: #555; margin: 0; }
        .totals { margin-bottom: 20px; }
        .totals h3 { font-size: 16px; margin-bottom: 10px; }
        .totals p { font-size: 14px; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Title Section -->
        <div class="title">
            <h1>Laporan Keuangan - {{ $LastMonthYear }}</h1>
            <p>{{ Auth::user()->gereja->nama }}</p>
            <p>Waktu Unduh: {{ $downloadTime }}</p>
        </div>

        <!-- Totals Section -->
        <div class="totals">
            <h3>Total</h3>
            <p><strong>Pemasukan:</strong> Rp. {{ number_format($totalPemasukan, 2, ',', '.') }}</p>
            <p><strong>Pengeluaran:</strong> Rp. {{ number_format($totalPengeluaran, 2, ',', '.') }}</p>
            <p><strong>Saldo:</strong> Rp. {{ number_format($saldo, 2, ',', '.') }}</p>
        </div>

        <!-- Pemasukan Table -->
        <h3>Pemasukan</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pemasukan as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>Rp. {{ number_format($item->nominal, 2, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada transaksi pemasukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pengeluaran Table -->
        <h3>Pengeluaran</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengeluaran as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>Rp. {{ number_format($item->nominal, 2, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada transaksi pengeluaran</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
