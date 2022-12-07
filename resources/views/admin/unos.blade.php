@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        @if(Session::has('movie-created-msg'))
            <div class="alert alert-success" role="alert">
                {{session('movie-created-msg')}}
            </div>
            @endif
        @if(Session::has('movie-deleted-msg'))
            <div class="alert alert-danger" role="alert">
                {{session('movie-deleted-msg')}}
            </div>
            @endif

            <div class="card">
                <div class="card-header">Upload Movie</div>

                <div class="card-body">
                    <form action="{{route('admin.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form group">
                            <label for="naslov">Naslov:</label>
                            <input type="text" class="form-control {{($errors->has('naslov')) ? 'is-invalid' : ''}}" name="naslov">
                            @error('naslov')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form group">
                            <label for="zanr">Žanr:</label>
                            <select name="id_zanra" class="form-select {{($errors->has('id_zanra')) ? 'is-invalid' : ''}}">
                                <option value="">Choose option</option>
                                @foreach($ganres as $ganre)
                                    <option value="{{$ganre->id}}">{{$ganre->naziv}}</option>
                                @endforeach
                            </select>
                            @error('id_zanra')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form group">
                            <label for="godina">Godina:</label>
                            <select name="godina" id="godina" class="form-select {{($errors->has('godina')) ? 'is-invalid' : ''}}">
                                <option value="">Choose option</option>
                                @for($year = 1900; $year <= 2022; $year++) 
                                    <option value="{{$year}}">{{$year}}</option>
                                @endfor
                            </select>
                            @error('godina')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="trajanje">Trajanje filma:</label>
                            <input id="appt-time" type="time" name="trajanje" class="form-control {{($errors->has('trajanje')) ? 'is-invalid' : ''}}">
                            @error('trajanje')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="slika">Slika naslova</label>
                            <input name="slika" type="file" class="form-control {{($errors->has('slika')) ? 'is-invalid' : ''}}">
                            @error('slika')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <br>
                            <button class="btn btn-success">Upload</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<!-- End of upload form -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Uploaded Movies</div>

                <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Slika</th>
                            <th>Naslov filma</th>
                            <th>Godina</th>
                            <th>Trajanje</th>
                            <th>Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($movies as $movie)
                        <tr>
                            <th>{{$movie->id}}</th>
                            <td>
                                <img width="50px" src="{{$movie->slika}}" alt="">
                            </td>
                            <td>{{$movie->naslov}}</td>
                            <td>{{$movie->godina}}</td>
                            <td>{{$movie->trajanje}}</td>
                            <td>
                                <form action="{{route('admin.destroy', $movie->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection