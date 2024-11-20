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
        $validated = $request->validate([
            'nm_kos' => 'required',
            'foto' => 'required|image',
            'description' => 'required',
            'tipe' => 'required'
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('uploads/kos'), $filename);
            $validated['foto'] = $filename;
        }

        $kos = Kos::create($validated);

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
            'foto' => 'nullable|image',
            'description' => 'required',
            'tipe' => 'required'
        ]);

        $kos = Kos::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Delete old image
            if ($kos->foto) {
                $oldPath = public_path('uploads/kos/' . $kos->foto);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Upload new image
            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('uploads/kos'), $filename);
            $validated['foto'] = $filename;
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
            $path = public_path('uploads/kos/' . $kos->foto);
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
