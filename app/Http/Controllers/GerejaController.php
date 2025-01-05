<?php

namespace App\Http\Controllers;

use App\Models\Gereja;
use App\Http\Requests\StoreGerejaRequest;
use App\Http\Requests\UpdateGerejaRequest;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Log;

class GerejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gereja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGerejaRequest $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Gereja::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Gereja berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gereja $gereja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gereja $gereja)
    {
        return view('admin.gereja.edit', compact('gereja'));
    }

    public function update(UpdateGerejaRequest $request, Gereja $gereja)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $gereja->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Gereja berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gereja $gereja)
    {
        $gereja->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Gereja berhasil dihapus.');
    }
}
