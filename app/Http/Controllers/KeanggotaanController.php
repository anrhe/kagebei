<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Import the Request class
use App\Models\Keanggotaan;
use App\Http\Requests\StoreKeanggotaanRequest;
use App\Http\Requests\UpdateKeanggotaanRequest;
use App\Imports\KeanggotaanImport;
use App\Models\Gereja;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
    public function index(Request $request)
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
        $gereja = Gereja::getAllGereja();
        return view('admin.anggota.create', compact('gereja'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKeanggotaanRequest $request)
    {
        $request->validate([
            'id_gereja' => 'required|exists:gereja,id',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'umur' => 'required|integer|min:0',
            'status_anggota' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'kelompok_doa' => 'required|string|max:255',
            'pendidikan_terakhir' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
        ]);

        Keanggotaan::create($request->all());

        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Anggota berhasil ditambahkan.');
        } else {
            return redirect()->route('admin.gereja.dashboard')->with('success', 'Anggota berhasil ditambahkan.');
        }
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
    public function edit(Keanggotaan $anggota)
    {
        $gereja = Gereja::getAllGereja();
        return view('admin.anggota.edit', compact('anggota', 'gereja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeanggotaanRequest $request, Keanggotaan $anggota)
    {
        $request->validate([
            'id_gereja' => 'required|exists:gereja,id',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'umur' => 'required|integer|min:0',
            'status_anggota' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'kelompok_doa' => 'required|string|max:255',
            'pendidikan_terakhir' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
        ]);
    
        $anggota->update($request->all());
    
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Anggota berhasil ditambahkan.');
        } else {
            return redirect()->route('admin.gereja.dashboard')->with('success', 'Anggota berhasil ditambahkan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keanggotaan $anggota)
    {
        $anggota->delete();

        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Anggota berhasil ditambahkan.');
        } else {
            return redirect()->route('admin.gereja.dashboard')->with('success', 'Anggota berhasil ditambahkan.');
        }
    }


    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate(
            [
                'file' => 'required|mimes:csv,xlsx,xls|max:2048',
            ],
            [
                'file.required' => 'Tolong masukan file terlebih dahulu.', // Custom message for 'required'
                'file.mimes'    => 'Format file harus berupa CSV, XLSX, atau XLS.', // Custom message for 'mimes'
                'file.max'      => 'Ukuran file tidak boleh lebih dari 2MB.', // Custom message for 'max'
            ]
        );
    

        try {
            $idGereja = Auth::user()->id_gereja;
            // Import the data using Laravel Excel
            Excel::import(new KeanggotaanImport($idGereja), $request->file('file'));

            return back()->with('success', 'Data anggota berhasil diunggah dan disimpan ke database.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
