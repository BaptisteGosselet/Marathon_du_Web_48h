@extends('layouts.app')
@section('content')
        <!--presentation-->
        <section id="presentation">
            <div id="banner" style="background-image: url({{asset('/img/Banniere_Marathon.jpg')}})">
                <div id="overlay"></div>
                <h1>Bienvenue !</h1>
            </div>
        </section>
        <section id="echantAffiches">
            <h1>Series les plus récentes</h1>
            

            <div>
            @foreach ($series as $serie)
                <div>
                    <a href="{{ route('showSerie', ['id' => $serie->id]) }}"><img src="{{$serie->urlImage}}"></a> <!--hover-->
                    <h2>{{$serie->nom}}</h2>
                    <p>{!! \Illuminate\Support\Str::limit($serie->resume,30,$end="...") !!}<b></b></p>
                </div>
            @endforeach
            </div>

        </section>

@endsection
