<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use Illuminate\Http\Request;

class KosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kos = Kos::all();
        return view('admin.kos.index', compact('kos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nm_kos' => 'required',
            'foto_kos' => 'required|image|mimes:jpg,png,jpeg',
            'deskripsi_kos' => 'required',
            'tipe_kos' => 'required',
        ]);

        if ($request->hasFile('foto_kos')) {
            $fotoPath = $request->file('foto_kos')->store('uploads/kos', 'public');;
        }

        $kos = Kos::create([
            'nm_kos' => $request->nm_kos,
            'foto_kos' => $fotoPath,
            'deskripsi_kos' => $request->deskripsi_kos,
            'tipe_kos' => $request->tipe_kos,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kos berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kos = Kos::findOrFail($id);
        return view('admin.kos.show', compact('kos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kos = Kos::findOrFail($id);
        return view('admin.kos.edit', compact('kos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nm_kos' => 'required',
            'foto_kos' => 'nullable|image',
            'deskripsi_kos' => 'required',
            'tipe_kos' => 'required'
        ]);

        $kos = Kos::findOrFail($id);

        if ($request->hasFile('foto_kos')) {
            if ($kos->foto_kos) {
                $oldPath = storage_path('app/public/' . $kos->foto_kos);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $fotoPath = $request->file('foto')->store('uploads/kos', 'public');

            $validated['foto'] = $fotoPath;
        }

        $kos->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kos berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kos = Kos::findOrFail($id);
        
        // Delete image file
        if ($kos->foto) {
            $path = storage_path('app/public/' . $kos->foto);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $kos->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kos berhasil dihapus'
        ]);
    }
}
