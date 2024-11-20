<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kuliner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class KulinerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kuliner.index');
    }

    /**
     * Get data for DataTables.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        $kuliners = Kuliner::select(['id', 'foto', 'nm_kuliner', 'description']);

        return DataTables::of($kuliners)
            ->addColumn('foto', function ($kuliner) {
                return '<img src="'.asset('storage/'.$kuliner->foto).'" alt="Foto Kuliner" width="50">';
            })
            ->addColumn('action', function ($kuliner) {
                return '
                    <a href="'.route('kuliner.edit', $kuliner->id).'" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteKuliner('.$kuliner->id.')">
                        <i class="fas fa-trash"></i>
                    </button>';
            })
            ->rawColumns(['foto', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kuliner.create');
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
            'nm_kuliner' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string'
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('kuliner', 'public');
            $validated['foto'] = $fotoPath;
        }

        Kuliner::create($validated);

        return response()->json([
            'message' => 'Data kuliner berhasil ditambahkan'
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
        $kuliner = Kuliner::findOrFail($id);
        return view('admin.kuliner.edit', compact('kuliner'));
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
        $kuliner = Kuliner::findOrFail($id);

        $validated = $request->validate([
            'nm_kuliner' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string'
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($kuliner->foto) {
                Storage::disk('public')->delete($kuliner->foto);
            }
            
            $fotoPath = $request->file('foto')->store('kuliner', 'public');
            $validated['foto'] = $fotoPath;
        }

        $kuliner->update($validated);

        return response()->json([
            'message' => 'Data kuliner berhasil diperbarui'
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
        $kuliner = Kuliner::findOrFail($id);

        // Hapus foto dari storage
        if ($kuliner->foto) {
            Storage::disk('public')->delete($kuliner->foto);
        }

        $kuliner->delete();

        return response()->json([
            'message' => 'Data kuliner berhasil dihapus'
        ]);
    }
}
