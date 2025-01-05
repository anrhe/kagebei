<?php

namespace App\Http\Controllers;

use App\Models\Gereja;
use App\Models\Keanggotaan;
use App\Models\Transaksi;
use App\Models\User;
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

    public function adminDashboard()
    {
        $gerejas = Gereja::getAllGereja();

        $keanggotaan = Keanggotaan::getAllAnggota();

        $users = User::getAllUsersExceptCurrentUser(Auth::id());

        return view('admin.dashboard', compact('gerejas', 'keanggotaan', 'users'));
    }
}
