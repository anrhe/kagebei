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
        $gerejas = Gereja::getAllGereja();

        $keanggotaan = Keanggotaan::getAllAnggota();

        $users = User::getAllUsersExceptCurrentUser(Auth::id());

        return view('admin.dashboard', compact('gerejas', 'keanggotaan', 'users'));
    }

    public function dashboardAdminGereja()
    {
        $gerejaId = Auth::user()->id_gereja;

        $gereja = Gereja::find($gerejaId);

        // Use paginate instead of get
        $keanggotaan = Keanggotaan::where('id_gereja', $gerejaId)
                        ->paginate(30); // 10 items per page

        $keanggotaan->getCollection()->transform(function ($anggota) {
            $anggota->jenis_kelamin = $anggota->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
            $anggota->tanggal_lahir = Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d F Y');
            return $anggota;
        });

        return view('admin.gereja.dashboard', compact('gereja', 'keanggotaan'));
    }
}
