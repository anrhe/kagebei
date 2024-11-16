<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest; // Import the Request class
use App\Models\Keanggotaan;
use App\Http\Requests\StoreKeanggotaanRequest;
use App\Http\Requests\UpdateKeanggotaanRequest;
use Illuminate\Support\Facades\Auth;


class KeanggotaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * This function is an index() method that displays a list of Keanggotaan records
     * associated with the logged-in user's gereja. The records are paginated with
     * 50 items per page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpRequest $request)
    {
        $gerejaId = Auth::user()->id_gereja;

        // Query builder for filtering
        $query = Keanggotaan::where('id_gereja', $gerejaId);

        // Filtering Logic
        if ($request->filled('kategori')) {  // Check if 'kategori' is present AND not empty
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

        // Get unique values for filter options
        $allKategori = Keanggotaan::where('id_gereja', $gerejaId)->distinct()->pluck('kategori');
        $allKelompokDoa = Keanggotaan::where('id_gereja', $gerejaId)->distinct()->pluck('kelompok_doa');
        $allStatusAnggota = Keanggotaan::where('id_gereja', $gerejaId)->distinct()->pluck('status_anggota');

        // Paginate the filtered results
        $keanggotaan = $query->paginate(50);

        return view('keanggotaan', compact('keanggotaan', 'allKategori', 'allKelompokDoa', 'allStatusAnggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKeanggotaanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Keanggotaan $keanggotaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keanggotaan $keanggotaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeanggotaanRequest $request, Keanggotaan $keanggotaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keanggotaan $keanggotaan)
    {
        //
    }
}
