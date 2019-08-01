<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\MovieResource;
use App\Movie;

class MovieController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movie::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = Movie::create([            
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'genre' => $request->genre,
            'description' => $request->description,
            'imdb_rating' => $request->imdb_rating
          ]);
    
          return new MovieResource($movie);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return new MovieResource($movie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        $movie = Movie::findOrFail($id);

        $movie->update($request->only(['title', 'genre', 'description', 'imdb_rating']));

        return new MovieResource($movie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        $movie->delete();

        return response()->json(null, 204);
    }
}
