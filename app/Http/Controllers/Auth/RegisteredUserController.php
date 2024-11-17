<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Gereja;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
       // Mendapatkan list nama dan id dari semua gereja
       $gereja = Gereja::all()->pluck('nama', 'id');

        return view('auth.register', compact('gereja'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createNewUser(Request $request): RedirectResponse
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pengguna'], // perbaikan di sini
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id_gereja' => ['required', 'exists:gereja,id'],
        ]);

        Log::info("Validasi berhasil! Silakan login.");
        Log::info(request()->all());

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_gereja' => $request->id_gereja, 
        ]);

        Log::info("Registrasi berhasil! Silakan login.");   

        event(new Registered($user));
        // Redirect ke halaman login setelah registrasi
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

}
