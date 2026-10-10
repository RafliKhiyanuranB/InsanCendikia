<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Services\ImageCompressorService;
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
            'foto_kos' => 'required|image|mimes:jpg,png,jpeg,webp|max:10240',
            'deskripsi_kos' => 'required',
            'tipe_kos' => 'required',
        ]);

        if ($request->hasFile('foto_kos')) {
            $fotoPath = ImageCompressorService::compressAndStore($request->file('foto_kos'), 'uploads/kos', 'public');
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
            'foto_kos' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:10240',
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

            $fotoPath = ImageCompressorService::compressAndStore($request->file('foto_kos'), 'uploads/kos', 'public');

            $validated['foto_kos'] = $fotoPath;
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
        if ($kos->foto_kos) {
            $path = storage_path('app/public/' . $kos->foto_kos);
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
