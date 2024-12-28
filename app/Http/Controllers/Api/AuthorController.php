<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author; // harus ada ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index(){
        $authors = Author::all(); 
        return response()->json($authors);
    }

    public function store(Request $request){
        //1. validasi
        $validator = Validator::make($request->all(), [
            "name" => "required|string|Max:255",
            "photo" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",//2mb buat foto
            "bio" => "nullable|string|"
        ]);

        // 2. cek validator
        if($validator->fails()) {
            return response()->json([ 
                "succcess" => false,
                "message" => $validator->errors()
            ], 422);
        }

        //3. upload image
        $image = $request->file('photo'); 
        $image->store('authors','public');// pakai php artisan storage:link
        

        //4. insert data
        $author = Author::create([
            "name" => $request -> name,
            "photo" => $image-> hashName(),
            "bio" => $request -> bio
        ]); // dari request validator

        // 5.return response
        return response()->json([ //ketika berhasil
            "success" => true,
            "message" => "Resource added succesfully",
            "data" => $author
        ], 201);
    }

    public function show(string $id){
        $author = Author::find($id);

        if(!$author) {
            return response()->json([ 
                "succcess" => false,
                "message" => "Resource not found"
            ], 404);
        }

        return response()->json([ //ketika berhasil
            "success" => true,
            "message" => "Get all resource",
            "data" => $author
        ], 200);
    }
}
