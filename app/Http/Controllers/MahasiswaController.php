<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{

    public function getDataTest()
    {
        $mahasiswa = Mahasiswa::all();
        return response()->json($mahasiswa);
    }

    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', ['mahasiswa' => $mahasiswa]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'kelas' => 'required|max:255',
        ]);

         Mahasiswa::create($validatedData);

        return redirect('/mahasiswa')->with('success', 'Mahasiswa baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mahasiswa = Mahasiswa::find($id);
         if (!$mahasiswa) {
            return redirect('/mahasiswa')->with('error', 'Mahasiswa tidak ditemukan!');
        }

        return view('mahasiswa.show', ['mahasiswa' => $mahasiswa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return redirect('/mahasiswa')->with('error', 'Mahasiswa tidak ditemukan!');
        }

        return view('mahasiswa.edit', ['mahasiswa' => $mahasiswa]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return redirect('/mahasiswa')->with('error', 'Mahasiswa tidak ditemukan!');
        }

        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'kelas' => 'required|max:255',
        ]);

        $mahasiswa->update($validatedData);

        return redirect('/mahasiswa')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return redirect('/mahasiswa')->with('error', 'Mahasiswa tidak ditemukan!');
        }

        $mahasiswa->delete();

        return redirect('/mahasiswa')->with('success', 'Mahasiswa berhasil dihapus!');
    }
}
