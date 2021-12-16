<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
// USER : id, name, email, email_verified_at, password, administrateur, avatar

{
    function show($id) {
        $user = User::where('id',$id)->firstOrFail();
        $comments_not_validated = Comment::where('validated',0)->take(2)->get();
        $comments2 = $user->comments->sortByDesc('created_at')->where('validated',1)->take(2);
        $titles = array();
        foreach($comments_not_validated as $comment) {
            $titles[] = Serie::find($comment->serie_id)->nom;
        }
        $episodes = $user->seen->sortByDesc('created_at');
        $last = "";
        $series2 = array();
        $totalTime = 0;
        foreach($episodes as $episode) {
            if($last != $episode->serie) {
                $last = $episode->serie;
                if(count($series2) < 2)
                    $series2[] = $last;
            }
            $totalTime += $episode->duree;
        }
        return view('profil_user',[
            'user' => $user,
            'comments_not_validated' => $comments_not_validated,
            'comments2' => $comments2,
            'titles' => $titles,
            'series2' => $series2,
            'totalTime' => $totalTime
        ]);

    }
    
}
