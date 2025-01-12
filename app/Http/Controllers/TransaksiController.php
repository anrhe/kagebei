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
        // Get available weeks with transactions
        $availableWeeks = Transaksi::selectRaw("
            TO_CHAR(tanggal, 'WW') as week_number, 
            TO_CHAR(DATE_TRUNC('week', tanggal), 'YYYY-MM-DD') as week_start, 
            TO_CHAR(DATE_TRUNC('week', tanggal) + INTERVAL '6 days', 'YYYY-MM-DD') as week_end
        ")
        ->groupBy('week_number', 'week_start', 'week_end')
        ->orderBy('week_number', 'desc')
        ->get();
    
        // Format available weeks for dropdown
        $formattedWeeks = [];
        foreach ($availableWeeks as $week) {
            $startDate = Carbon::createFromFormat('Y-m-d', $week->week_start)->translatedFormat('d F Y');
            $endDate = Carbon::createFromFormat('Y-m-d', $week->week_end)->translatedFormat('d F Y');
            $formattedWeeks[$week->week_number] = "$startDate - $endDate";
        }
    
        // Check if a specific week is selected
        $weekFilter = $request->query('week');
        $query = Transaksi::query();
    
        if ($weekFilter) {
            $query->whereRaw("TO_CHAR(tanggal, 'WW') = ?", [$weekFilter]);
        }
    
        // Separate income and expense transactions
        $incomeTransactions = (clone $query)->where('tipe', 'pemasukan')->orderBy('created_at', 'desc')->get();
        $expenseTransactions = (clone $query)->where('tipe', 'pengeluaran')->orderBy('created_at', 'desc')->get();
    
        // Format tanggal for income transactions
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
            'availableWeeks' => $formattedWeeks, 
            'incomeTransactions' => $incomeTransactions,
            'expenseTransactions' => $expenseTransactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance,
        ]);
    }
}
