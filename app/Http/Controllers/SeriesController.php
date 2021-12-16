<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Episode;
use App\Models\Seen;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Monolog\Handler\RedisHandler;

class SeriesController extends Controller
{
    
    function show($id) {
        $serie = Serie::where('id', $id)->firstOrFail();
        $sommeDuree = 0;
        $idEpisodes = array();
        foreach($serie->episodes as $episode) {
            $sommeDuree += $episode->duree;
            $idEpisodes[] = $episode->id;
        }
        if(Auth::check()) {
            $vues = Auth::user()->seen->whereIn('episode_id', $idEpisodes);
        } else {
            $vues = $serie;
        }
        return view('detail', [
            'serie' => $serie,
            'episodes' => $serie->episodes,
            'comments' => $serie->comments,
            'duree' => $sommeDuree,
            'vues' => $vues,
            'nbVues' => $vues->count()
        ]);
    }

    function addComment(Request $request, $idSerie) {
        if(Auth::check()) {
            $userId = Auth::user()->id;
            if(Auth::user()->administrateur == 1)
                $validated = 1;
            else 
                $validated = 0;
            Comment::create([
                'content' => '<p>' . $request->content . '</p>',
                'note' => $request->note,
                'user_id' => $userId,
                'serie_id' => $idSerie,
                'validated' => $validated
            ]);
            return redirect()->route('showSerie', ['id' => $idSerie]);
        }
    }


    function validerComment($idSerie, $idComment) {
        if(Auth::check()) {
            Comment::where('id',$idComment)->update([
                    "validated" => 1
            ]);
        }
        return redirect()->route('showSerie', ['id' => $idSerie]);
    }

    function addSerieView($idSerie) {
        $serie = Serie::find($idSerie);
        foreach($serie->episodes as $episode) {
            if((Seen::where('user_id', Auth::id())->where('episode_id', $episode->id)->first()) == null) {
                Seen::create([
                    'user_id' => Auth::id(),
                    'episode_id' => $episode->id,
                    'date_seen' => now()
                ]);
            }
        }
        return redirect()->route('showSerie', ['id' => $idSerie]);
    }

    function removeSerieView($idSerie) {
        $serie = Serie::find($idSerie);
        foreach($serie->episodes as $episode) {
            Seen::where('episode_id', $episode->id)->delete();
        }
        return redirect()->route('showSerie', ['id' => $idSerie]);
    }

    function deleteComment($idSerie, $idComment) {
        $comment = Comment::findOrFail($idComment);
        $comment->delete();
        return redirect()->route('showSerie', ['id' => $idSerie]);
    }

    function addAvis(Request $request, $idSerie) {
        $serie = Serie::findOrFail($idSerie);
        $serie->update([
            'avis' => $request->avis
        ]);
        return redirect()->route('showSerie', ['id' => $idSerie]);
    }

    function addUrl(Request $request, $idSerie) {
        $serie = Serie::findOrFail($idSerie);
        $serie->update([
            'urlAvis' => $request->url
        ]);
        return redirect()->route('showSerie', ['id' => $idSerie]);
    }
}