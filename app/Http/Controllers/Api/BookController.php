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
            "title" => "required|string|max:255",
            "description" => "required|string",
            "price" => "required|numeric|min:0",
            "stock" => "required|integer|min:0",
            "cover_photo" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "genre_id" => "required|exists:genres,id",
            "author_id" => "required|exists:authors,id"
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
            "title"=>$request->title,
            "description"=>$request->description,
            "price"=>$request->price,
            "stock"=>$request->stock,
            "cover_photo"=>$image->hashName(),
            "genre_id"=>$request->genre_id,
            "author_id"=>$request->author_id
        ]); // dari request validator

        // 5.return response
        return response()->json([ //ketika berhasil
            "success" => true,
            "message" => "Resource added succesfully",
            "data" => $book
        ], 201);
    }

    public function show(string $id){
        $book = Book::find($id);

        if(!$book) {
            return response()->json([ 
                "succcess" => false,
                "message" => "Resource not found"
            ], 404);
        }

        return response()->json([ //ketika berhasil
            "success" => true,
            "message" => "Get all resource",
            "data" => $book
        ], 200);
    }
}
