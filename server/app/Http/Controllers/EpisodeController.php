<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getAllEpisodeByMovieId']]);
    }

    public function getAllEpisodeByMovieId($id)
    {
        try {
            $eps = Episode::where('movie_id', $id)->orderBy('episode', 'asc')->paginate();

            return response()->json([
                'success' => true,
                'message' => 'Episodes Fetched by MovieId Successfully!',
                'episodes' => $eps
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function createEpisode(Request $request)

    {
        $request->validate([
            'movie_id' => 'required|numeric',
            'episode' => 'required|numeric',
            'link' => 'nullable|string'
        ]);
        try {

            $movie = Movie::find($request->movie_id);

            if (!$movie) return response()->json([
                'success' => false,
                'message' => 'Movie not Found!'
            ], 404);

            $ep = new Episode();

            $ep->movie_id = $request->movie_id;
            $ep->episode = $request->episode;
            $ep->link = $request->link;

            $ep->save();

            return response()->json([
                'success' => true,
                'message' => 'Movie Created Successfully!',
                'episode' => $ep
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
