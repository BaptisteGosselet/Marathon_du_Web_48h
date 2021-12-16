@extends('layouts.app')
@section('content')
<section id="details">
    <h1>Détail d'une série</h1>
<div>
    <div id="desc">
        <p>Nom : {{ $serie->nom }}<br>
            Genre : {{ $serie->genre }}<br>
            Langue : {{ $serie->langue }}<br>
            Date de sortie : {{ $serie->premiere }}</p>
        @if (isset($serie->avis))
            <p>Avis rédaction : {{ $serie->avis }} </p>
        @endif
        @guest
        @else
        @if (Auth::user()->administrateur == 1)
        <form action="{{ route('addAvis', ['id' => $serie->id]) }}" method="get">
            <textarea name="avis" cols="20" rows="3" placeholder="Avis rédaction"></textarea>
            <button type="submit">Ajouter l'avis</button>
        </form>
        @endif
        @endguest
        @if (isset($serie->urlAvis))
        <a href="{{ asset($serie->urlAvis)}}">
            <video controls width="250px" height='100px'>
                <source src="{{ asset($serie->urlAvis)}}" type="video/mp4"> 
            </video>
        </a>
        @endif
        @guest 
        @else 
        @if (Auth::user()->administrateur == 1)
        <p>url : {{ $serie->urlAvis }} </p>
        <form action="{{ route('addUrl', ['id' => $serie->id]) }}" method="get">
            <textarea name="url" id="" cols="20" rows="3" placeholder="URL vidéo"></textarea>
            <button type="submit">Ajouter l'url</button>
        </form>
        @endif
        @endguest
       
        @guest 
        @else 
        <p><a href="{{ route('addSerieView', ['id' => $serie->id])}}"><b>Ajouter la série aux vues</b></a></p>
        <p><a href="{{ route('removeSerieView', ['id' => $serie->id])}}"><b>Supprimer la série des vues</b></a></p>
        @endguest
        
        <p><a href="#comments">Voir les commentaires</a></p>
    </ul><br>

    <div id="stat">
        <h3>Statistiques</h3>
            <p>Note : {{$serie->note}} / 10<br>
                Nombre de vues : {{ $nbVues }}<br>
                Nombre de commentaires : {{$serie->comments->count()}} <br>
                Durée totale : {{$duree}} min</p>

    </div>

</div>

<div>
    <h3></h3>
    <?php //video ?>
</div>

<div>
    <div id="episodes">
    <h3>Episodes</h3>
        <?php $s = 0; ?>
        @foreach ($episodes as $episode)
            <?php
            if($s != $episode->saison) {
                $s = $episode->saison; ?>
                <p><b>Saison {{ $s }}<b></p> <?php
            }
            ?>
            <p>Épisode {{$episode->numero}} : {{ $episode->nom }}</p>
            <img src="{{asset($episode->urlImage)}}">


        @endforeach
    </div>

    @guest 
    @else
    @if(Auth::user()->administrateur == 1)
    <div id="admin">
        <h3 id="comments">ADMIN : Valider les commentaires</h3><br>
            @if ($comments->count() > 0)
                <?php $nbComments = 0; ?>
                
                    @foreach ($comments as $comment)
                        @if($comment->validated == 0)
                            <?php $nbComments++;?>
                            
                            <p>Commentaire de <a href="{{route('showUser', ['id' => $comment->utilisateur->id])}}">{{ $comment->utilisateur->name }}</a> : {!! $comment->content !!}</p>
                            <a href="{{ route('validerComment', ['idSerie' => $serie->id, 'idComment' => $comment->id]) }}">Valider</a><br>
                            <a href="{{ route('deleteComment', ['id' => $comment->serie_id, 'idComment' => $comment->id]) }}">Supprimer le commentaire</a>
                        @endif
                    @endforeach
            @endif
        @endif
        @endguest
    </div>

    <div id="addCommentaire">
        <h3>Ajouter un commentaire</h3>
        <form action="{{ route('addComment', ['id' => $serie->id]) }}" method="post">
            @csrf
            @guest
            <label for="note">Note sur 10</label>
            <input type="number" name="note" id="note" min="0" max="10" disabled><br>
            <label for="content">Commentaire</label><br>
            <textarea name="content" id="content" cols="30" rows="10" disabled>Connectez vous pour ajouter un commentaire.</textarea>
            <button type="submit" disabled>Envoyer</button>
            @else
            <label for="note">Note sur 10</label>
            <input type="number" name="note" id="note" min="0" max="10" required><br>
            <label for="content">Commentaire</label><br>
            <textarea name="content" id="content" cols="30" rows="5" required></textarea>
            <button type="submit">Envoyer</button>
            @endguest
        </form>
    </div>
    <div id="commentaires">

        <h3 id="comments">Commentaires</h3>
        @if ($comments->count() > 0)
            <?php $nbComments = 0; ?>
            <ul>
                @foreach ($comments as $comment)
                <?php $nbComments++;?>
                <br><br>
                @guest
                @else
                @if ($comment->validated == 1 || ((Auth::id() == $comment->utilisateur->id || Auth::user()->administrateur == 1)))
                    <p>
                        Commentaire de <a href="{{route('showUser', ['id' => $comment->utilisateur->id])}}">{{ $comment->utilisateur->name }}</a> : {!!$comment->content!!}
                    </p>
                @endif
                @endguest
                @guest 
                @else
                @if (Auth::id() == $comment->utilisateur->id || Auth::user()->administrateur == 1 && $comment->validated == 1)
                    <a href="{{ route('deleteComment', ['id' => $comment->serie_id, 'idComment' => $comment->id]) }}">Supprimer le commentaire</a>
                @endif
                @endguest
                @endforeach
            </ul>
        @else
            <span>Pas de commentaires</span>
        @endif
    </div>
</div>

    <h3 id="comments">Commentaires</h3>
    @if ($comments->count() > 0)
        <?php $nbComments = 0; ?>
        <ul>
            @foreach ($comments as $comment)
            <?php $nbComments++;?>
            <br><br>
            @guest
            @if ($comment->validated == 1)
                <li>
                    Commentaire de <a href="{{route('showUser', ['id' => $comment->utilisateur->id])}}">{{ $comment->utilisateur->name }}</a> : {!!$comment->content!!}
                </li>
            @endif
                
            @else
            @if ($comment->validated == 1 || ((Auth::id() == $comment->utilisateur->id || Auth::user()->administrateur == 1)))
                <li>
                    Commentaire de <a href="{{route('showUser', ['id' => $comment->utilisateur->id])}}">{{ $comment->utilisateur->name }}</a> : {!!$comment->content!!}
                </li>
            @endif
            @endguest
            @guest
            @else
            @if (Auth::id() == $comment->utilisateur->id || Auth::user()->administrateur == 1 && $comment->validated == 1)
                <a href="{{ route('deleteComment', ['id' => $comment->serie_id, 'idComment' => $comment->id]) }}">Supprimer le commentaire</a>
            @endif
            @endguest
            @endforeach
        </ul>
    @else
        <span>Pas de commentaires</span>
    @endif
    <br><h3>Ajouter un commentaire</h3>
    <form action="{{ route('addComment', ['id' => $serie->id]) }}" method="post">
        @csrf
        @guest
        <label for="note">Note sur 10</label>
        <input type="number" name="note" id="note" min="0" max="10" disabled><br>
        <label for="content">Commentaire</label><br>
        <textarea name="content" id="content" cols="30" rows="10" disabled>Connectez vous pour ajouter un commentaire.</textarea>
        <button type="submit" disabled>Envoyer</button>
        @else
        <label for="note">Note sur 10</label>
        <input type="number" name="note" id="note" min="0" max="10" required><br>
        <label for="content">Commentaire</label><br>
        <textarea name="content" id="content" cols="30" rows="5" required></textarea>
        <button type="submit">Envoyer</button>
        @endguest
    </form>
@endsection

