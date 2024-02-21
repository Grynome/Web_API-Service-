<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Mov_Genres;
use DB;

class MGController extends Controller
{
    
    /**
     * @OA\Get(
     *     path="/movies",
     *     tags={"List Movie"},
     *     summary="Get All Data from Movie",
     *     description="Retrieve information about movies with genres",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="mov_id", type="integer"),
     *                 @OA\Property(property="judul", type="string"),
     *                 @OA\Property(property="Genre", type="string"),
     *                 @OA\Property(property="release_date", type="date"),
     *                 @OA\Property(property="producer", type="string"),
     *                 @OA\Property(property="rating", type="decimal"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *     ),
     * )
     */
    public function view()
    {
        $sub = DB::table('list_movie as m')
            ->leftJoin('mov_genres as mg', 'm.mov_id', '=', 'mg.mov_id')
            ->leftJoin('genres as g', 'mg.genres_id', '=', 'g.genres_id')
            ->select('m.mov_id', 'judul', 'g.name', 'release_date', 'producer', 'rating')
            ->toSql();

        $query = DB::table(DB::raw("({$sub}) as aa"))
            ->select('mov_id', 'judul', DB::raw('GROUP_CONCAT(`name`) as Genre'), 'release_date', 'producer', 'rating')
            ->groupBy('mov_id')
            ->get();

        return $query;
    }
    
    public function index()
    {
        return Mov_Genres::select('mov_id', 'genres_id')
            ->with('get_mov:mov_id,judul')
            ->with('get_genre:genres_id,name')
            ->get();
    }

    public function define(Request $request)
    {
        return Mov_Genres::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $mv_g = Mov_Genres::find($id);

        if (!$mv_g) {
            return response()->json(['message' => 'Genre Movie not found'], 404);
        }

        $result = $mv_g->update($request->only(['mov_id', 'genres_id']));
        if ($result) {
            return $mv_g;
        }else {
            return response()->json(['message' => 'Failed Update'], 404);
        }
    }

    public function destroy($id)
    {
        $mv_g = Mov_Genres::find($id);

        if (!$mv_g) {
            return response()->json(['message' => 'Genre Movie not found'], 404);
        }

        $executed = $mv_g->delete();
        if ($executed) {
            return response()->json(['message' => 'Genre Movie deleted successfully']);
        }else {
            return response()->json(['message' => 'Genre Movie deleted failed']);
        }
    }
}
