<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return new OrderResource(true,"Get All Resource", $orders);
    }
    public function store(Request $request){
        //1. validasi
        $validator = Validator::make($request->all(), [
            "book_id" => "required|exists:books,id",
            "quantity" => "required|integer|min:1"
        ]);

        // 2. cek validator
        if($validator->fails()) {
            return response()->json([
                "succcess" => false,
                "message" => $validator->errors()
            ], 422);
        }

        //Buat-nomor order unik
        $orderNumber = "ORD-" . strtoupper(uniqid());


        //Ambil data user yang sedang login
        $user = auth('api')->user();

        // cek logi user
        if(!$user){
            return response()->json([
                "succcess" => false,
                "message" => "Unauthorized!"
            ], 401);
        }

        // Ambil 1 data buku
        $book = Book::find($request->book_id);
        //dd($book);

        // check stok barang
        if($book->stock < $request->quantity) {
            return response()->json([
                "succcess" => false,
                "message" => "Stok barang tidak cukup"
            ], 400);
        }

        // hitung total harga
        $totalAmount = $book->price*$request->quantity;

        //kurangi stok buku
        $book->stock -= $request->quantity;
        $book->save();

        // 3. insert data
        $order = Order::create([
            "order_number"=>$orderNumber,
            "customer_id"=>$user->id,
            "book_id"=>$request->book_id,
            "total_amount"=>$totalAmount,
            "status"=>"pending",
            "staff_confirmed_by" =>$user->id,
            "staff_confirmed_at" => now()

        ]); // dari request validator

           // 4.return response
        return response()->json([ //ketika berhasil
            "success" => true,
            "message" => "Order Berhasil di Terima",
            "data" => $order
        ], 201);

    }
}
