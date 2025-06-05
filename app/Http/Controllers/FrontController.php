<?php

namespace App\Http\Controllers;

use App\Models\BeritaTerkini;
use App\Models\Event;
use App\Models\Info;
use App\Models\Kabupaten;
use App\Models\Kos;
use App\Models\Kuliner;
use App\Models\Pariwisata;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $event = Event::all();
        $kos = Kos::all();
        $kuliner = Kuliner::all();
        $info = Info::all();
        return view('front.index', compact('event', 'kos', 'kuliner', 'info'));
    }

    public function detailShow($tipe, $id)
    {
        if ($tipe === 'event') {
            $data = Event::findOrFail($id);
        } elseif ($tipe === 'kuliner') {
            $data = Kuliner::findOrFail($id);
        } elseif($tipe === 'info') {
            $data = Info::findOrFail($id);
        } elseif($tipe === 'kos') {
            $data = Kos::findOrFail($id);
        } else {
            abort(404, 'Halaman tidak ditemukan');
        }
    
        return view('front.detail', compact('data', 'tipe'));
    }

    public function infoKos()
    {
        $kos = Kos::all();
        return view('front.infokos', compact('kos'));
    }

    public function kuliner()
    {
        $kuliner = Kuliner::all();
        return view('front.kuliner', compact('kuliner'));
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
    
}
