<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $movies = [ //variable yg menyimpan array ini property
        [ "id" => 11, "title" => "Budi Pekerti", "genre" => "Drama", "produser" => "Adi","release_year" => 2023, "country" => "Indonesia"],
        [ "id" => 12, "title" => "Resident Evil", "genre" => "Action", "produser" => "Ren","release_year" => 2015, "country" => "America"],
        [ "id" => 13, "title" => "Toy Story 3", "genre" => "Action", "produser" => "Joe","release_year" => 2020, "country" => "England"],
        [ "id" => 14, "title" => "Iron Man 1", "genre" => "Action", "produser" => "Jose","release_year" => 2008, "country" => "German"],
        [ "id" => 15, "title" => "Darknight", "genre" => "Drama", "produser" => "Jack","release_year" => 2007, "country" => "Australia"],
        [ "id" => 16, "title" => "Captain America", "genre" => "Action", "produser" => "Mary","release_year" => 2010, "country" => "Mexico"],
        [ "id" => 17, "title" => "The Incredible", "genre" => "Action", "produser" => "Idi","release_year" => 2006, "country" => "India"] 
    ];

    public function getAllMovies(){  //php artisan serve ini method
        return $this->movies;
    }
}
?>