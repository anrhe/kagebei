<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaksi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'transaksi';
    public $incrementing = false;

    public static function getWeeklyTotals($numWeeks = 5)
    {
        $user = Auth::user();
        $gerejaId = $user->id_gereja;
        
        // Get the start and end dates for each of the past $numWeeks weeks
        $weeks = collect(range(1, $numWeeks))->map(function ($weekNumber) {
            $startDate = Carbon::now()->subWeeks($weekNumber)->startOfWeek();
            $endDate = Carbon::now()->subWeeks($weekNumber)->endOfWeek();
            return [$startDate, $endDate];
        });

        // Query the database for each week, filtering by id_gereja
        $weeklyTotals = $weeks->map(function ($week) use ($gerejaId) { 
            [$startDate, $endDate] = $week;

            $totalPemasukan = Transaksi::where('id_gereja', $gerejaId)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->where('tipe', 'Pemasukan')
                ->sum('nominal');

            $totalPengeluaran = Transaksi::where('id_gereja', $gerejaId)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->where('tipe', 'Pengeluaran')
                ->sum('nominal');

            return $totalPemasukan - $totalPengeluaran;
        });

        return $weeklyTotals;
    }

    public function gereja()
    {
        return $this->belongsTo(Gereja::class, 'id_gereja');
    }
}
