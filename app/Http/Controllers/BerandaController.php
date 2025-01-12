<?php

namespace App\Http\Controllers;

use App\Models\Gereja;
use App\Models\Keanggotaan;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    /**
     * Display the main dashboard page.
     *
     * This function retrieves the counts of each category of keanggotaan and
     * weekly transaction totals, and passes them to the dashboard view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Retrieve the counts of each category of keanggotaan
        $categoryCounts = Keanggotaan::getCategoryCounts();

        // Retrieve the weekly transaction totals
        $weeklyTotals = Transaksi::getWeeklyTotals();
    
        // Pass the counts and totals to the dashboard view
        return view('dashboard', compact('categoryCounts', 'weeklyTotals'));
    }

    public function dashboardAdminGlobal()
    {
        $gerejas = Gereja::with('pengguna')->get();

        return view('admin.dashboard', compact('gerejas'));
    }

    public function dashboardAdminGereja(Request $request)
    {
        $gerejaId = Auth::user()->id_gereja;
    
        $gereja = Gereja::find($gerejaId);
    
        // Query builder for filtering
        $query = Keanggotaan::where('id_gereja', $gerejaId);
    
        // Filtering logic
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->input('kategori'));
        }
        if ($request->filled('kelompok_doa')) {
            $query->where('kelompok_doa', $request->input('kelompok_doa'));
        }
        if ($request->filled('status_anggota')) {
            $query->where('status_anggota', $request->input('status_anggota'));
        }
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->input('jenis_kelamin'));
        }
        if ($request->filled('umur_min')) {
            $query->where('umur', '>=', $request->input('umur_min'));
        }
        if ($request->filled('umur_max')) {
            $query->where('umur', '<=', $request->input('umur_max'));
        }
    
        // Paginated results
        $keanggotaan = $query->paginate(30);
    
        $keanggotaan->getCollection()->transform(function ($anggota) {
            $anggota->jenis_kelamin = $anggota->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
            $anggota->tanggal_lahir = Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d F Y');
            return $anggota;
        });
    
        // Get unique values for filter options
        $allKategori = Keanggotaan::where('id_gereja', $gerejaId)->distinct()->pluck('kategori');
        $allKelompokDoa = Keanggotaan::where('id_gereja', $gerejaId)->distinct()->pluck('kelompok_doa');
        $allStatusAnggota = Keanggotaan::where('id_gereja', $gerejaId)->distinct()->pluck('status_anggota');
    
        return view('admin.gereja.dashboard', compact('gereja', 'keanggotaan', 'allKategori', 'allKelompokDoa', 'allStatusAnggota'));
    }
}
