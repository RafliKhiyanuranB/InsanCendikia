<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.event.index', compact('events'));
    }

    /**
     * Get event data for DataTables.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEventData()
    {
        $events = Event::select(['id', 'nm_event', 'foto', 'description', 'tanggal', 'waktu', 'lokasi']);

        return datatables()->of($events)
            ->addColumn('foto', function($event) {
                return asset('uploads/event/' . $event->foto);
            })
            ->addColumn('action', function($event) {
                $editUrl = route('event.edit', $event->id);
                return '
                    <a href="'.$editUrl.'" class="btn btn-primary btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="'.$event->id.'">Hapus</button>
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
        return view('admin.event.create');
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
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nm_event' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'lokasi' => 'required|string',
            'description' => 'required'
        ]);

        try {
            // Proses upload foto
            $fotoPath = $request->file('foto')->store('event-photos', 'public');
            
            Event::create([
                'foto' => $fotoPath,
                'nm_event' => $validated['nm_event'],
                'tanggal' => $validated['tanggal'],
                'waktu' => $validated['waktu'],
                'lokasi' => $validated['lokasi'],
                'description' => $validated['description']
            ]);

            return response()->json([
                'message' => 'Event berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan event',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.event.edit', compact('event'));
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
            'nm_event' => 'required',
            'foto' => 'nullable|image',
            'description' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'lokasi' => 'required'
        ]);

        $event = Event::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Delete old image
            if ($event->foto) {
                $oldPath = public_path('uploads/event/' . $event->foto);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Upload new image
            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('uploads/event'), $filename);
            $validated['foto'] = $filename;
        }

        $event->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Event berhasil diupdate'
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
        $event = Event::findOrFail($id);
        
        // Delete image file
        if ($event->foto) {
            $path = public_path('uploads/event/' . $event->foto);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event berhasil dihapus'
        ]);
    }
}
