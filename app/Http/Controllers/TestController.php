<?php

namespace App\Http\Controllers;

use App\Models\Keanggotaan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
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
        return view('testopage', compact('categoryCounts', 'weeklyTotals'));
    }
}
