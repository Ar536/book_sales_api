<?php

namespace App\Http\Controllers; //bikin controller

use App\Models\Book;
use Illuminate\Http\Request; // abu-abu karena belum digunakan

class BookController extends Controller
{

    public function index() //method
    {
        $book = new Book; //object
        $books = $book->getAllBooks();// akses method dari objek movie

        return response()->json($books);
    }

}
?>