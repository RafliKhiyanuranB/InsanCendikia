<?php

namespace App\Http\Controllers;

use App\Models\BeritaTerkini;
use App\Models\Event;
use App\Models\Kabupaten;
use App\Models\Kuliner;
use App\Models\Pariwisata;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $kabupatens = Kabupaten::all();
        $pariwisata = Pariwisata::all();
        $kuliner = Kuliner::all();
        $beritaterkini = BeritaTerkini::all();
        $event = Event::all();
        return view('front.index', compact('kabupatens', 'pariwisata', 'kuliner', 'beritaterkini', 'event'));
    }

    public function detailShow($tipe, $id)
    {
        if ($tipe === 'pariwisata') {
            $data = Pariwisata::findOrFail($id);
        } elseif ($tipe === 'kuliner') {
            $data = Kuliner::findOrFail($id);
        } elseif($tipe === 'beritaterkini') {
            $data = BeritaTerkini::findOrFail($id);
        } elseif($tipe === 'event') {
            $data = Event::findOrFail($id);
        } else {
            abort(404, 'Halaman tidak ditemukan');
        }
    
        return view('front.detail', compact('data', 'tipe'));
    }
    
}
