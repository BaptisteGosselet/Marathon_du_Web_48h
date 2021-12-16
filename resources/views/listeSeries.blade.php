
@extends('layouts.app')
@section('content')

    <section id="listMovies">
        <form action="{{ route('showFiltreSerie') }}" method="GET">
            <label for="">Filtrer par : </label>
            <select name="filtre" id="">
                <option value="nom"
                <?php
                    if(isset($filtre) && $filtre == 'nom') echo 'selected';
                ?>>Nom</option>
                <option value="genre"
                <?php
                    if(isset($filtre) && $filtre == 'genre') echo 'selected';
                ?>>Genre</option>
                <option value="langue"
                <?php
                    if(isset($filtre) && $filtre == 'langue') echo 'selected';
                ?>>Langue</option>
            </select>
            <button type="submit">Trier</button>
        </form><br>

        @if (isset($texte))
            <h1>Résultat pour "{{ $texte }}"</h1>
        @else
        <h1>Toutes les séries</h1>
        @endif
        
        <div id="allMovies">
            @if ($series->count() > 0)
                @foreach ($series as $serie)
                    <div class="movies">
                        <a href="{{ route('showSerie', ['id' => $serie->id])}}"><img src="{{ asset($serie->urlImage)}}"></a>
                        <h2> <a href="{{ route('showSerie', ['id' => $serie->id])}}">{{ \Illuminate\Support\Str::limit($serie->nom, 15, $end='...') }}</a></h2>
                    </div>
                @endforeach
            @else
            <div class="movies">
                <h2>Pas de série</h2>
            @endif
        </div>
    </section>
@endsection

