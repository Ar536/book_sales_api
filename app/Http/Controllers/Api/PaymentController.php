<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index(){
        $payments = Payment::all(); //elequent
        return new PaymentController(true,"Get All Resource", $payments);
    }
    public function store(Request $request){
        //1. validasi
        $validator = Validator::make($request->all(), [
            "order_id" => "required|exists:orders,id",
            "payment_method_id" => "required|exists:payment_methods,id",
        ]);

        // 2. cek validator
        if($validator->fails()) {
            return response()->json([
                "succcess" => false,
                "message" => $validator->errors()
            ], 422);
        }

        $order =Order::find($request->order_id);

        //4. insert data
        $payment_method = Payment::create([
            "order_id" => $request->order_id,
            "payment_method_id" => $request->payment_method_id,
            "amount" => $order->total_amount,
            "status" => "pending",

        ]);

        // 5.return response
        return response()->json([ //ketika berhasil
            "success" => true,
            "message" => "Resource added succesfully",
            "data" => $payment_method
        ], 201);
    }


    public function update(Request $request, string $id){
        //cari data genre
        $payment = Payment::find($id);


        if(!$payment) {
            return response()->json([
                "succcess" => false,
                "message" => "Resource not found!"
            ], 404);
        };


        $validator = Validator::make($request->all(), [
            "status" => "required|string"
        ]);

        if($validator->fails()) {
            return response()->json([
                "succcess" => false,
                "message" => $validator->errors()
            ], 422);
        }

        //update data baru
        $payment->update([
            "status" => $request->status,
            "staff_confirmed_by" =>auth('api')->user()->name,
            "staff_confirmed_at" => now()
        ]);

        return response()->json([
            "succcess" => true,
            "message" => "Resource updated successfully!",
            "data" => $payment
        ], 200);

        $data = [
            "title"=>$request->title,
            "description"=>$request->description,
            "price"=>$request->price,
            "stock"=>$request->stock,
            "genre_id"=>$request->genre_id,
            "author_id"=>$request->author_id
        ];




    }

    public function destroy(string $id){
        $payment =Payment::find($id);

        if(!$payment) {
            return response()->json([
                "succcess" => false,
                "message" => "Resource not found!",
            ], 404);
        };

        return response()->json([
            "succcess" => true,
            "message" => "Resource deleted successfully",
        ], 200);
    }
}
