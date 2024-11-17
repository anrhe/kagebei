<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gereja extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'gereja';

    public function pengguna() 
    {
        return $this->hasMany(User::class, 'id_gereja'); 
    }

    public function keanggotaan() 
    {
        return $this->hasMany(Keanggotaan::class, 'id_gereja'); 
    }

    public function transaksi() 
    {
        return $this->hasMany(Transaksi::class, 'id_gereja'); 
    }

    public function getAllGereja()
    {
        return Gereja::all();
    }
}
