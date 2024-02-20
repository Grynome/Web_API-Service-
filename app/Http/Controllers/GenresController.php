<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genres;

class GenresController extends Controller
{
    public function index()
    {
        return Genres::select('genres_id', 'name')->get();
    }

    public function show(Request $request)
    {
        $ids = $request->input('ids');
        return Genres::where('genres_id', $ids)->get();
    }

    public function store(Request $request)
    {
        return Genres::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $genres = Genres::find($id);

        if (!$genres) {
            return response()->json(['message' => 'Genres not found'], 404);
        }

        $result = $genres->update($request->only(['name']));
        if ($result) {
            return $genres;
        }else {
            return response()->json(['message' => 'Failed Update'], 404);
        }
    }

    public function destroy($id)
    {
        $genres = Genres::find($id);

        if (!$genres) {
            return response()->json(['message' => 'Genres not found'], 404);
        }

        $executed = $genres->delete();
        if ($executed) {
            return response()->json(['message' => 'Genres deleted successfully']);
        }else {
            return response()->json(['message' => 'Genres deleted failed']);
        }
    }
}
