<?php

namespace App\Imports;

use App\Models\Keanggotaan;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class KeanggotaanImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $idGereja;

    // Constructor to inject the authenticated user's id_gereja
    public function __construct($idGereja)
    {
        $this->idGereja = $idGereja;
    }

    /**
     * Map each row from the Excel file into the keanggotaan table.
     */
    public function model(array $row)
    {
        return new Keanggotaan([
            'id'                 => Str::uuid(), // Generate a UUID
            'id_gereja'          => $this->idGereja, // Use the injected id_gereja
            'nama'               => $row['nama'], // Ensure these match the Excel file headers
            'jenis_kelamin'      => $row['jenis_kelamin'],
            'kelompok_doa'       => $row['kelompok_doa'] ?? null,
            'tanggal_lahir'      => $row['tanggal_lahir'],
            'umur'               => $row['umur'],
            'pendidikan_terakhir'=> $row['pendidikan_terakhir'] ?? null,
            'pekerjaan'          => $row['pekerjaan'] ?? null,
            'jabatan'            => $row['jabatan'] ?? null,
            'status_anggota'     => $row['status_anggota'],
            'kategori'           => $row['kategori'],
        ]);
    }

    /**
     * Validate the uploaded file.
     */
    public function rules(): array
    {
        return [
            'nama'               => ['required', 'string', 'max:255'],
            'jenis_kelamin'      => ['required', 'in:L,P'],
            'kelompok_doa'       => ['nullable', 'string', 'max:255'],
            'tanggal_lahir'      => ['required', 'date'],
            'umur'               => ['required', 'integer', 'min:0'],
            'pendidikan_terakhir'=> ['nullable', 'string', 'max:255'],
            'pekerjaan'          => ['nullable', 'string', 'max:255'],
            'jabatan'            => ['nullable', 'string', 'max:255'],
            'status_anggota'     => ['required', 'string', 'max:255'],
            'kategori'           => ['required', 'string', 'max:255'],
        ];
    }
}
