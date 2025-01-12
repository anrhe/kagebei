<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksiRequest $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:Pemasukan,Pengeluaran',
            'nominal' => 'required|numeric',
            'created_at' => 'required|date',
            // You can add other validations if needed
        ]);

        $request->merge(['id_gereja' => Auth::user()->id_gereja]);

        // Create the laporan and assign the logged-in user's id_gereja
        Transaksi::create($request->all());

        return redirect()->route('admin.gereja.dashboard')->with('success', 'Laporan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $laporan)
    {
        return view('admin.transaksi.edit', compact('laporan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'nominal' => 'required|numeric',
            'created_at' => 'required|date',
        ]);

        $transaksi->update($request->validated());

        return redirect()->route('admin.gereja.dashboard')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('admin.gereja.dashboard')->with('success', 'Laporan berhasil dihapus.');
    }

    public function summary(Request $request)
    {
        // Get filter inputs
        $selectedYear = $request->query('year', null);
        $selectedMonth = $request->query('month', null);
        $selectedWeek = $request->query('week', null);
    
        // Get the id_gereja from the authenticated user
        $idGereja = Auth::user()->id_gereja;
    
        // Fetch available years filtered by id_gereja
        $availableYears = Transaksi::selectRaw("TO_CHAR(tanggal, 'YYYY') as year")
            ->where('id_gereja', $idGereja)
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
    
        // Fetch available months based on the selected year and id_gereja
        $availableMonths = [];
        if ($selectedYear) {
            $availableMonths = Transaksi::selectRaw("
                    TO_CHAR(tanggal, 'MM') as month,
                    TO_CHAR(tanggal, 'Month') as month_name
                ")
                ->where('id_gereja', $idGereja)
                ->whereRaw("TO_CHAR(tanggal, 'YYYY') = ?", [$selectedYear])
                ->groupBy('month', 'month_name')
                ->orderBy('month', 'asc')
                ->get();
        }
    
        // Fetch available weeks based on the selected year, month, and id_gereja
        $availableWeeks = [];
        if ($selectedYear && $selectedMonth) {
            $availableWeeks = Transaksi::selectRaw("
                    TO_CHAR(tanggal, 'WW') as week,
                    TO_CHAR(DATE_TRUNC('week', tanggal), 'YYYY-MM-DD') as start_date,
                    TO_CHAR(DATE_TRUNC('week', tanggal) + INTERVAL '6 days', 'YYYY-MM-DD') as end_date
                ")
                ->where('id_gereja', $idGereja)
                ->whereRaw("TO_CHAR(tanggal, 'YYYY') = ?", [$selectedYear])
                ->whereRaw("TO_CHAR(tanggal, 'MM') = ?", [$selectedMonth])
                ->groupBy('week', 'start_date', 'end_date')
                ->orderBy('start_date', 'asc')
                ->get();
        }
    
        // Filter transactions by id_gereja
        $query = Transaksi::where('id_gereja', $idGereja);
        if ($selectedYear) {
            $query->whereRaw("TO_CHAR(tanggal, 'YYYY') = ?", [$selectedYear]);
        }
        if ($selectedMonth) {
            $query->whereRaw("TO_CHAR(tanggal, 'MM') = ?", [$selectedMonth]);
        }
        if ($selectedWeek) {
            $query->whereRaw("TO_CHAR(tanggal, 'WW') = ?", [$selectedWeek]);
        }
    
        // Separate income and expense transactions
        $incomeTransactions = (clone $query)->where('tipe', 'pemasukan')->orderBy('created_at', 'desc')->get();
        $expenseTransactions = (clone $query)->where('tipe', 'pengeluaran')->orderBy('created_at', 'desc')->get();
    
        // Format dates in transactions
        foreach ($incomeTransactions as $transaction) {
            $transaction->tanggal = Carbon::parse($transaction->tanggal)->translatedFormat('d F Y');
        }
        foreach ($expenseTransactions as $transaction) {
            $transaction->tanggal = Carbon::parse($transaction->tanggal)->translatedFormat('d F Y');
        }
    
        // Calculate totals
        $totalIncome = $incomeTransactions->sum('nominal');
        $totalExpense = $expenseTransactions->sum('nominal');
        $balance = $totalIncome - $totalExpense;
    
        // Pass data to the view
        return view('admin.transaksi.summary', [
            'availableYears' => $availableYears,
            'availableMonths' => $availableMonths,
            'availableWeeks' => $availableWeeks,
            'incomeTransactions' => $incomeTransactions,
            'expenseTransactions' => $expenseTransactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance,
            'selectedYear' => $selectedYear,
            'selectedMonth' => $selectedMonth,
            'selectedWeek' => $selectedWeek,
        ]);
    }    
}
