<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Episode;
use App\Models\Serie;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    
    function show() {

        $series_triees = Serie::orderby('premiere', 'desc')->get();
        $series_triees_5 = array();
        for($i=0;$i<5;$i++){
            array_push($series_triees_5,$series_triees[$i]);
        }

        return view('welcome', [
            'series' => $series_triees_5
        ]);
    }


}
