php<?php

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AnggotaImport;

public function import(Request $request)
{
    // Validasi file
    $request->validate([
        'file' => 'required|mimes:csv,xlsx|max:2048', // Hanya menerima file CSV atau Excel
    ]);

    try {
        // Proses file menggunakan Laravel Excel
        Excel::import(new AnggotaImport, $request->file('file'));

        // Redirect dengan pesan sukses
        return redirect()->route('admin.gereja.dashboard')->with('success', 'File berhasil diunggah dan diproses!');
    } catch (\Exception $e) {
        // Redirect dengan pesan error
        return redirect()->route('admin.gereja.dashboard')->with('error', 'Terjadi kesalahan saat memproses file.');
    }
}
