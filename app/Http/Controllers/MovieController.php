<?php

namespace App\Http\Controllers; //bikin controller

use App\Models\Movie;
use Illuminate\Http\Request; // abu-abu karena belum digunakan

class MovieController extends Controller
{

    public function index() //method
    {
        $movie = new Movie; //object
        $movies = $movie->getAllMovies();// akses method dari objek movie

        return response()->json($movies);
    }

}
?>