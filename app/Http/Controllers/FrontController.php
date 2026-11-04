<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Info;
use App\Models\Kos;
use App\Models\Kuliner;
use App\Models\Berita;
use App\Models\Artikel;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $event   = Event::all();
        $info    = Info::all();
        $berita  = Berita::latest()->get();
        $artikel = Artikel::latest()->get();
        return view('front.index', compact('event', 'info', 'berita', 'artikel'));
    }

    public function detailShow($tipe, $id)
    {
        if ($tipe === 'event') {
            $data = Event::findOrFail($id);
        } elseif ($tipe === 'kuliner') {
            $data = Kuliner::findOrFail($id);
        } elseif ($tipe === 'info') {
            $data = Info::findOrFail($id);
        } elseif ($tipe === 'kos') {
            $data = Kos::findOrFail($id);
        } elseif ($tipe === 'berita') {
            $data = Berita::findOrFail($id);
        } elseif ($tipe === 'artikel') {
            $data = Artikel::findOrFail($id);
        } else {
            abort(404, 'Halaman tidak ditemukan');
        }

        return view('front.detail', compact('data', 'tipe'));
    }

    public function infoKos()
    {
        return redirect()->route('front.index');
    }

    public function kuliner()
    {
        return redirect()->route('front.index');
    }

    public function event()
    {
        $event = Event::all();
        return view('front.event', compact('event'));
    }

    public function info()
    {
        $info = Info::all();
        return view('front.info', compact('info'));
    }

    public function berita()
    {
        $berita = Berita::latest()->get();
        return view('front.berita', compact('berita'));
    }

    public function artikel()
    {
        $artikel = Artikel::latest()->get();
        return view('front.artikel', compact('artikel'));
    }
}
