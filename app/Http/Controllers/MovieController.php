<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Film;
use App\Models\Zanr;
use App\Http\Requests\MovieRequest;

class MovieController extends Controller
{
    //
    public function index() 
    {   
        
        $movies = Film::orderBy('naslov', 'asc')->get();
        return view('index', [
            'movies'=>$movies,
            'alphabet'=>Film::Alphabet(),
        ]);
    }
    public function search($letter) 
    {
         $movies = Film::where('naslov', 'LIKE', $letter . '%')->selectRaw('*, LEFT (naslov, 1) as first_char')->get();
         return view('search', ['movies'=>$movies]);
        
    }
    public function show($id) 
    {
        $movie = Film::findOrFail($id);
        return view('show', [
            'movie'=>$movie,
        ]);
    }
    public function create() 
    {   
        $movies = Film::orderBy('naslov', 'asc')->get();
        $ganres = Zanr::orderBy('naziv', 'asc')->get();
        return view('admin.unos', [
            'movies'=>$movies,
            'ganres'=>$ganres,
        ]);
    }
    public function store(MovieRequest $request) 
    {
        $input = $request->all();
        $input['naslov'] = ucfirst($request->naslov);
        if($file = $request->file('slika')) {
            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $input['slika'] = $name;
        }
        
        Film::create($input);
        session()->flash('movie-created-msg', 'Movie uploaded successfully');
        return back();
    }
    public function destroy($id) 
    {
        $movie = Film::findOrFail($id);
        $movie->delete();

        session()->flash('movie-deleted-msg', 'Movie deleted successfully');
        return back();
    }
}
