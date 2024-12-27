<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book; // harus ada ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index(){
        $books = Book::all(); //elequent
        // $books = DB::select('SELECT * FROM books') //
        return response()->json($books);
    }
    public function store(Request $request){
        //1. validasi
        $validator = Validator::make($request->all(), [
            "title" => "required|string|Max:255",
            "description" => "required|string",
            "price" => "required|string",
            "stock" => "required|string|integer",
            "cover_photo" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "genre_id" => "required|exists:genres,id",
            "author_id" => "required|exists:author,id"
        ]);

        // 2. cek validator
        if($validator->fails()) {
            return response()->json([ 
                "succcess" => false,
                "message" => $validator->errors()
            ], 422);
        }

        //3. upload image
        $image = $request->file('cover_photo'); 
        $image->store('books','public');// pakai php artisan storage:link
        

        //4. insert data
        $book = Book::create([
            "title" => $request -> title,
            "description" => $request -> description,
            "price" => $request -> price,
            "stok" => $request -> stok,
            "cover_photo" => $image-> hashName(),
            "genre_id" => $request -> bio,
            "author_id" => $request -> bio
        ]); // dari request validator

        // 5.return response
        return response()->json([ //ketika berhasil
            "success" => true,
            "message" => "Resource added succesfully",
            "data" => $book
        ], 201);
    }
}
