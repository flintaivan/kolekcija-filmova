@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
    <div class="d-inline-block text-center">
        @foreach($alphabet as $letter)
            <a href="{{route('movie.search', $letter)}}" class="btn btn-default btn-outline-secondary btn-sm text-decoration-none">{{$letter}}</a> 
        @endforeach   
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        @foreach($movies as $movie)
        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="{{$movie->slika}}" alt="Card image cap">
                <div class="card-body text-center">
                <h5 class="card-title">{{$movie->naslov . ' ('.$movie->godina.')' }}</h5>
                <p class="card-text">Trajanje: {{$movie->trajanje}}</p>

                <form action="#">
                    @csrf
                    <button class="btn btn-outline-dark">Show more</button>
                </form>
                
                </div>
                <div class="card-footer">
                <small class="text-muted">{{$movie->created_at->diffForHumans()}}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection