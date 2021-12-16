<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use App\Http\Controllers\listeSeries;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\DB;

class ListeController extends Controller
{
    function show(){
        return view('listeSeries',  [
            'series' => Serie::orderby('nom')->get()
        ]);
    }

    function showFiltre(Request $request) {
        switch ($request->get('filtre')) {
            case 'genre':
                $series = Serie::orderby('genre')->get();
                break;
            case 'langue':
                $series = Serie::orderby('langue')->get();
                break;
            case 'nom':
                return redirect()->route('listeSeries');
        }
        return view('listeSeries',  [
            'series' => $series,
            'filtre' => $request->get('filtre')
        ]);
    }

    function search(Request $request) {
        $recherche = $request->txt;
        $series = DB::table('series')->where('nom', 'like', $recherche.'%')->get();
        return view('listeSeries',  [
            'series' => $series,
            'texte' => $request->txt
        ]);
    }
}
