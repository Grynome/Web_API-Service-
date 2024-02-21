<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genres;
use App\Models\Mov_Genres;

class MVController extends Controller
{
    public function index()
    {
        return Movie::select('mov_id', 'judul', 'release_date', 'producer', 'rating')->get();
    }
    /**
     * @OA\Get(
     *     path="/data-movies/search",
     *     tags={"Get With Params"},
     *     summary="Search for movies",
     *     description="Search for movies based on the provided keyword",
     *     @OA\Parameter(
     *         name="keyword",
     *         in="query",
     *         required=true,
     *         description="Keyword to search for",
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="mov_id", type="integer"),
     *                 @OA\Property(property="judul", type="string"),
     *                 @OA\Property(property="release_date", type="date"),
     *                 @OA\Property(property="producer", type="string"),
     *                 @OA\Property(property="rating", type="string"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *     ),
     * )
     */
    public function show(Request $request)
    {
        $keyword = $request->input('keyword');
        return Movie::where('mov_id', "LIKE", "%$keyword%")
                    ->orWhere('judul', "LIKE", "%$keyword%")
                    ->orWhere('release_date', "LIKE", "%$keyword%")
                    ->orWhere('producer', "LIKE", "%$keyword%")
                    ->orWhere('rating', "LIKE", "%$keyword%")->get();
    }
    /**
     * @OA\Post(
     *     path="/store/data-movies",
     *     tags={"Store Data Movie"},
     *     summary="Create a new movie",
     *     description="Create a new movie record",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="judul", type="string"),
     *             @OA\Property(property="release_date", type="date"),
     *             @OA\Property(property="producer", type="string"),
     *             @OA\Property(property="rating", type="decimal"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Movie created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="mov_id", type="integer"),
     *             @OA\Property(property="judul", type="string"),
     *             @OA\Property(property="release_date", type="date"),
     *             @OA\Property(property="producer", type="string"),
     *             @OA\Property(property="rating", type="decimal"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object"),
     *         ),
     *     ),
     * )
     */
    public function store(Request $request)
    {
        return Movie::create($request->all());
    }
    /**
     * @OA\Post(
     *     path="/store/multiple",
     *     tags={"Store 2 Table"},
     *     summary="Create a new movie and genre",
     *     description="Create a new movie record and a new genre record",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="movies",
     *                 type="object",
     *                 @OA\Property(property="judul", type="string"),
     *                 @OA\Property(property="release_date", type="date", format="date"),
     *                 @OA\Property(property="producer", type="string"),
     *                 @OA\Property(property="rating", type="decimal", minimum=1.1, maximum=10.0),
     *             ),
     *             @OA\Property(
     *                 property="genres",
     *                 type="object",
     *                 @OA\Property(property="name", type="string"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Movie and genre created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="movies", type="object"),
     *             @OA\Property(property="genres", type="object"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object"),
     *         ),
     *     ),
     * )
     */
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
    /**
     * @OA\Put(
     *     path="/patch/data-movies/{id}",
     *     tags={"Update with Params"},
     *     summary="Update a movie",
     *     description="Update an existing movie record",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the movie to update",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="judul", type="string"),
     *             @OA\Property(property="release_date", type="date"),
     *             @OA\Property(property="producer", type="string"),
     *             @OA\Property(property="rating", type="decimal"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="mov_id", type="integer"),
     *             @OA\Property(property="judul", type="string"),
     *             @OA\Property(property="release_date", type="date"),
     *             @OA\Property(property="producer", type="string"),
     *             @OA\Property(property="rating", type="decimal"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object"),
     *         ),
     *     ),
     * )
     */
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
    /**
     * @OA\Delete(
     *     path="/destroy/data-movies/{id}",
     *     tags={"Delete with Params"},
     *     summary="Delete a movie",
     *     description="Delete an existing movie record",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the movie to delete",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     ),
     * )
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        $executed = $movie->delete();
        if ($executed) {
            Mov_Genres::where('mov_id', $id)->delete();
            return response()->json(['message' => 'Movie deleted successfully']);
        }else {
            return response()->json(['message' => 'Movie deleted failed']);
        }
    }
}
