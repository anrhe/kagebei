<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDate = Carbon::now();
        $lastMonth = $currentDate->copy()->subMonth();
        $startOfMonth = $lastMonth->startOfMonth()->toDateString();
        $endOfMonth = $lastMonth->endOfMonth()->toDateString();

        // Fetch pemasukan and pengeluaran transactions
        $pemasukan = Transaksi::where('tipe', 'pemasukan')
            ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->get();

        $pengeluaran = Transaksi::where('tipe', 'pengeluaran')
            ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->get();

        // Calculate totals
        $totalPemasukan = $pemasukan->sum('nominal');
        $totalPengeluaran = $pengeluaran->sum('nominal');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $pengumuman = Pengumuman::orderBy('created_at', 'desc')
                            ->orderBy('updated_at', 'desc')
                            ->paginate(10);
        return view('dashboard', compact('pengumuman', 'pemasukan', 'pengeluaran', 'totalPemasukan', 'totalPengeluaran', 'saldo', 'lastMonth'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengumuman.create'); // Return the form to create a pengumuman
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        Pengumuman::create([
            'id' => Str::uuid(),
            'id_pengguna' => Auth::user()->id, // Assuming the logged-in user creates the pengumuman
            'judul' => $validatedData['judul'],
            'isi' => $validatedData['isi'],
        ]);

        return redirect()->route('pengumuman')->with('success', 'Pengumuman berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman')); // Return the form to edit a pengumuman
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $pengumuman->update([
            'judul' => $validatedData['judul'],
            'isi' => $validatedData['isi'],
        ]);

        return redirect()->route('pengumuman')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()->route('pengumuman')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
