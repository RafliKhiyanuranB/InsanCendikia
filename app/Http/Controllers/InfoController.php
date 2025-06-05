<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = Info::all();
        return view('admin.info.index', compact('infos'));
    }

    /**
     * Get info data for DataTables.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        $infos = Info::select(['id', 'judul', 'tanggal', 'foto', 'description']);

        return datatables()->of($infos)
            ->addColumn('foto', function($info) {
                return asset('storage/' . $info->foto);
            })
            ->addColumn('action', function($info) {
                $editUrl = route('info.edit', $info->id);
                return '
                    <a href="'.$editUrl.'" class="btn btn-primary btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="'.$info->id.'">Hapus</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.info.create');
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
            'judul' => 'required',
            'foto' => 'required|image|mimes:jpg,png,jpeg',
            'description' => 'required',
            'tanggal' => 'required'
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads/info', 'public');;
        }

        Info::create([
            'judul' => $request->judul,
            'foto' => $fotoPath,
            'description' => $request->description,
            'tanggal' => $request->tanggal,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Info berhasil ditambahkan'
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
        $info = Info::findOrFail($id);
        return view('admin.info.show', compact('info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = Info::findOrFail($id);
        return view('admin.info.edit', compact('info'));
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
            'judul' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg',
            'description' => 'required',
            'tanggal' => 'required'
        ]);

        $info = Info::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($info->foto) {
                $oldPath = storage_path('app/public/' . $info->foto);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $fotoPath = $request->file('foto')->store('uploads/info', 'public');

            $validated['foto'] = $fotoPath;
        }

        $info->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Info berhasil diupdate'
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
        $info = Info::findOrFail($id);
        
        // Delete image file
        if ($info->foto) {
            $path = storage_path('app/public/' . $info->foto);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $info->delete();

        return response()->json([
            'success' => true,
            'message' => 'Info berhasil dihapus'
        ]);
    }
}
