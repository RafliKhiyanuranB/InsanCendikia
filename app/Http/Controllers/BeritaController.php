<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Services\ImageCompressorService;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beritas = Berita::all();
        return view('admin.berita.index', compact('beritas'));
    }

    /**
     * Get berita data for DataTables.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        $beritas = Berita::select(['id', 'judul', 'tanggal', 'foto', 'konten']);

        return datatables()->of($beritas)
            ->addColumn('foto', function($berita) {
                return asset('storage/' . $berita->foto);
            })
            ->editColumn('konten', function($berita) {
                $plain = strip_tags($berita->konten);
                return \Illuminate\Support\Str::limit($plain, 80, '...');
            })
            ->addColumn('action', function($berita) {
                $editUrl = route('berita.edit', $berita->id);
                return '
                    <a href="'.$editUrl.'" class="btn btn-primary btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="'.$berita->id.'">Hapus</button>
                ';
            })
            ->rawColumns(['foto', 'konten', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.berita.create');
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
            'foto'    => 'required|image|mimes:jpg,png,jpeg,webp|max:10240',
            'konten'  => 'required',
            'tanggal' => 'required|date',
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = ImageCompressorService::compressAndStore($request->file('foto'), 'uploads/berita', 'public');
        }

        Berita::create([
            'judul'   => $request->judul,
            'foto'    => $fotoPath,
            'konten'  => $request->konten,
            'tanggal' => $request->tanggal,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil ditambahkan'
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
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
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
            'foto'    => 'nullable|image|mimes:jpg,png,jpeg,webp|max:10240',
            'konten'  => 'required',
            'tanggal' => 'required|date',
        ]);

        $berita = Berita::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($berita->foto) {
                $oldPath = storage_path('app/public/' . $berita->foto);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $fotoPath = ImageCompressorService::compressAndStore($request->file('foto'), 'uploads/berita', 'public');
            $validated['foto'] = $fotoPath;
        }

        $berita->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil diupdate'
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
        $berita = Berita::findOrFail($id);

        // Delete image file
        if ($berita->foto) {
            $path = storage_path('app/public/' . $berita->foto);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $berita->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil dihapus'
        ]);
    }
}

