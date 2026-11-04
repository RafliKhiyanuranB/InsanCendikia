<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikels = Artikel::all();
        return view('admin.artikel.index', compact('artikels'));
    }

    /**
     * Get artikel data for DataTables.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        $artikels = Artikel::select(['id', 'judul', 'tanggal', 'penulis', 'konten']);

        return datatables()->of($artikels)
            ->editColumn('konten', function($artikel) {
                $plain = strip_tags($artikel->konten);
                return \Illuminate\Support\Str::limit($plain, 80, '...');
            })
            ->addColumn('action', function($artikel) {
                $editUrl = route('artikel.edit', $artikel->id);
                return '
                    <a href="'.$editUrl.'" class="btn btn-primary btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="'.$artikel->id.'">Hapus</button>
                ';
            })
            ->rawColumns(['konten', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.artikel.create');
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
            'judul'   => 'required|string|max:255',
            'konten'  => 'required',
            'tanggal' => 'required|date',
            'penulis' => 'required|string|max:255',
        ]);

        Artikel::create([
            'judul'   => $request->judul,
            'konten'  => $request->konten,
            'tanggal' => $request->tanggal,
            'penulis' => $request->penulis,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil ditambahkan'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('admin.artikel.edit', compact('artikel'));
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
            'judul'   => 'required|string|max:255',
            'konten'  => 'required',
            'tanggal' => 'required|date',
            'penulis' => 'required|string|max:255',
        ]);

        $artikel = Artikel::findOrFail($id);
        $artikel->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil diupdate'
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
        $artikel = Artikel::findOrFail($id);
        $artikel->delete();

        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil dihapus'
        ]);
    }
}

