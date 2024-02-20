<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genres;

class MVController extends Controller
{
    public function index()
    {
        return Movie::select('mov_id', 'judul', 'release_date', 'producer', 'rating')->get();
    }

    public function show(Request $request)
    {
        $keyword = $request->input('keyword');
        return Movie::where('mov_id', "LIKE", "%$keyword%")
                    ->orWhere('judul', "LIKE", "%$keyword%")
                    ->orWhere('release_date', "LIKE", "%$keyword%")
                    ->orWhere('producer', "LIKE", "%$keyword%")
                    ->orWhere('rating', "LIKE", "%$keyword%")->get();
    }

    public function store(Request $request)
    {
        return Movie::create($request->all());
    }
    
    public function store_2_table(Request $request)
    {
        $request->validate([
            'movies.judul' => 'required|string',
            'movies.release_date' => 'required|date',
            'movies.producer' => 'required|string',
            'movies.rating' => 'required|numeric|between:1.1,10.0',
            'genres.name' => 'required|string'
        ]);

        $movieData = $request->input('movies');

        $movies = Movie::create($movieData);

        $genresData = $request->input('genres');
        $genres = Genres::create($genresData);

        return ['movies' => $movies, 'genres' => $genres];
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        $result = $movie->update($request->only(['judul', 'release_date', 'producer', 'rating']));
        if ($result) {
            return $movie;
        }else {
            return response()->json(['message' => 'Failed Update'], 404);
        }
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        $executed = $movie->delete();
        if ($executed) {
            return response()->json(['message' => 'Movie deleted successfully']);
        }else {
            return response()->json(['message' => 'Movie deleted failed']);
        }
    }
}
