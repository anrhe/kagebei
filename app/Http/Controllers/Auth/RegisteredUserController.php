<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pengguna'], // perbaikan di sini
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Mendapatkan id_gereja
        $idGereja = $this->getIdGereja();

        // Pastikan id_gereja tidak null
        if (!$idGereja) {
            return redirect()->back()->withErrors(['id_gereja' => 'Gereja tidak ditemukan.']);
        }

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_gereja' => $idGereja, 
        ]);

        // Trigger event registrasi
        event(new Registered($user));

        // Redirect ke halaman login setelah registrasi
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    
    private function getIdGereja()
    {
        // Ambil id_gereja dari tabel gereja
        $gereja = DB::table('gereja')->first();
        return $gereja ? $gereja->id : null; // Pastikan mengembalikan id yang valid
    }
}
