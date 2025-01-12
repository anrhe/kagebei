<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Gereja;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $pengguna = User::with('gereja')->get();
        return view('admin.pengguna.index', compact('pengguna'));
    }

    public function listPengguna()
    {
        $users = User::all(); // Mengambil semua data pengguna
        return view('admin.list-pengguna', compact('users')); // Kirim data ke view
    }

    public function create()
    {
        $gereja = Gereja::all();
        return view('admin.pengguna.create', compact('gereja'));
    }

    public function store(StoreUserRequest $request)
    {
        $request->validate([
            'id_gereja' => 'required|exists:gereja,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,operator,gembala,user',
        ]);

        User::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $pengguna)
    {
        $gereja = Gereja::all();
        return view('admin.pengguna.edit', compact('pengguna', 'gereja'));
    }

    public function update(UpdateUserRequest $request, User $pengguna)
    {
        $request->validate([
            'id_gereja' => 'required|exists:gereja,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email,' . $pengguna->id,
            'role' => 'required|in:admin,operator,gembala,user',
        ]);

        $pengguna->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $pengguna)
    {
        $pengguna->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Pengguna berhasil dihapus.');
    }
}
