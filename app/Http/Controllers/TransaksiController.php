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

        // Get available months with transactions
        $availableMonths = Transaksi::selectRaw("TO_CHAR(tanggal, 'YYYY-MM') as month, TO_CHAR(tanggal, 'FMMonth YYYY') as label")
            ->groupBy('month', 'label')
            ->orderBy('month', 'desc')
            ->pluck('label', 'month');

        // Check if a specific month is selected
        $monthFilter = $request->query('month');
        $query = Transaksi::query();

        if ($monthFilter) {
            $query->whereRaw("TO_CHAR(tanggal, 'YYYY-MM') = ?", [$monthFilter]);
        }

        // Separate income and expense transactions
        $incomeTransactions = (clone $query)->where('tipe', 'pemasukan')->orderBy('created_at', 'desc')->get();
        $expenseTransactions = (clone $query)->where('tipe', 'pengeluaran')->orderBy('created_at', 'desc')->get();

        foreach ($incomeTransactions as $transaction) {
            $transaction->tanggal = Carbon::createFromFormat('Y-m-d', $transaction->tanggal)->translatedFormat('d F Y');
        }
    
        // Format tanggal for expense transactions
        foreach ($expenseTransactions as $transaction) {
            $transaction->tanggal = Carbon::createFromFormat('Y-m-d', $transaction->tanggal)->translatedFormat('d F Y');
        }

        // Calculate totals
        $totalIncome = $incomeTransactions->sum('nominal');
        $totalExpense = $expenseTransactions->sum('nominal');
        $balance = $totalIncome - $totalExpense;

        // Pass data to the view
        return view('admin.transaksi.summary', [
            'availableMonths' => $availableMonths,
            'incomeTransactions' => $incomeTransactions,
            'expenseTransactions' => $expenseTransactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance,
        ]);
    }
}
