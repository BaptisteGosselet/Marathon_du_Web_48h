@extends('layouts.app')
@section('content')

        <!--profil-->
        <section id="user">
            
            <div>
                <h1>{{ $user->name }}</h1>
                <img src="{{ asset($user->avatar) }}" width="150px" height="150px">
            </div>
            
            <div>
                <div>
                    <h2>Mes statistiques</h2>
                <div>
                    <div>
                        <h3>Heures passées à regarder les séries</h3>
                        <p>{{ round($totalTime / 60, 1)}} heures</p>
                    </div>
                    <div>
                        <h3>Épisodes vus</h3>
                        <p> {{ $user->seen->count() }}</p>
                    </div>
                    <div>
                        <h3>Avis postés</h3>
                        <p>{{ $user->comments->count() }}</p>
                    </div>

                    @guest
                    @else
                        @if(Auth::user()->administrateur == 1 and $user->id == Auth::user()->id)
                        <div>
                            <h3>Avis en attente</h3>
                            <p>{{ $comments_not_validated->count() }}</p>
                        </div>
                        @endif
                    @endguest
                </div>
            </div>
            <div>
                
                
                <h2>Séries vues</h2>
                @if (count($series2) > 0)
                    <div id="allSeries">
                    @foreach ($series2 as $serie)
                        <p class="serie">{{ $serie->nom }}</p>
                    @endforeach
                </div>
                @else
                <div id="allSeries">
                    <h3 class="serie">Pas de série vue</h3>
                </div>
                @endif
                

                @guest 
                @else 
                    @if($user->id == Auth::user()->id)
                    <h2>Mes commentaires</h2>
                    @else
                    <h2>Ses commentaires</h2>
                    @endif
                        <!--Les commentaires que l'utilisateur a posté-->
                    <div id="allPosts">
                        @if (count($comments2) > 0)
                            @foreach ($comments2 as $comment)
                            <?php $i=0;?>
                            <div class="post">
                                <h3><a href="{{ route('showSerie', ['id' => $comment->serie_id]) }}">{{ $comment->nom }}</a> : {{ $comment->created_at}}</h3>
                                <p>{{ $comment->note }} / 10 : {!! $comment->content !!}</p>
                            </div>
                            <?php $i++;?>
                            @endforeach
                        @else
                            <div class="post">
                                <h3>Aucun commentaire</h3>
                            </div>
                    @endif
                @endguest

                    
                </div>

                @guest 
                @else
                    @if(Auth::user()->administrateur == 1 and $user->id == Auth::user()->id)
                    <h2>Commentaires en attente de validation</h2>
                    <div id="allPosts">
                        @if (count($comments_not_validated) > 0)
                            @foreach ($comments_not_validated as $comment)
                            <?php $i=0;?>
                            <div class="post">
                                <h3><a href="{{ route('showSerie', ['id' => $comment->serie_id]) }}">{{ $titles[$i] }}</a> : {{ $comment->created_at}}</h3>
                                <p>{{ $comment->note }} / 10 : {!! $comment->content !!}</p>
                                <a href="{{ route('validerComment', ['idSerie' => $serie->id, 'idComment' => $comment->id]) }}">Valider</a>
                                <a href="{{ route('deleteComment', ['id' => $comment->serie_id, 'idComment' => $comment->id]) }}">Supprimer le commentaire</a>
                            </div>
                            <?php $i++;?>
                            @endforeach
                        @else
                            <div class="post">
                                <h3>Aucun commentaire</h3>
                            </div>
                        @endif
                    @endif
                @endguest    
                
                </div>

            </div>
        </section>

@endsection
