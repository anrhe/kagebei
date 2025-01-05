<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Keanggotaan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'keanggotaan';
    public $incrementing = false;
    protected $fillable = [
        'id_gereja',
        'nama',
        'jenis_kelamin',
        'kelompok_doa',
        'kategori',
        'tanggal_lahir',
        'umur',
        'pendidikan_terakhir',
        'pekerjaan',
        'jabatan',
        'status_anggota',
    ];

    public static function getCategoryCounts()
    {
        $user = Auth::user(); // Or however you retrieve the logged-in user

        // Check if user is logged in and has an associated gereja
        if ($user && $user->id_gereja) {
            return self::where('id_gereja', $user->id_gereja) // Filter by id_gereja
                ->select('kategori as nama', DB::raw('COUNT(kategori) as jumlah'))
                ->groupBy('kategori')
                ->get();
        } else {
            // Handle case where user is not logged in or doesn't have a church
            return collect(); // Return an empty collection
        }
    }

    public static function getAllAnggota()
    {
        return Keanggotaan::all();
    }

    public function gereja()
    {
        return $this->belongsTo(Gereja::class, 'id_gereja');
    }
}
