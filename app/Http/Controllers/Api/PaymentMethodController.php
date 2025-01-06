<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMethodResource;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    public function index(){
        $payment_methods = PaymentMethod::all(); //elequent
        return new PaymentMethodResource(true,"Get All Resource", $payment_methods);
    }
    public function store(Request $request){
        //1. validasi
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "account_number" => "required|string|max:255",
            "Image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        ]);

        // 2. cek validator
        if($validator->fails()) {
            return response()->json([
                "succcess" => false,
                "message" => $validator->errors()
            ], 422);
        }

        //3. upload image
        $image = $request->file('Image');
        $image->store('payment_methods','public');


        //4. insert data
        $payment_method = PaymentMethod::create([
            "name"=>$request->name,
            "account_number"=>$request->account_number,
            "Image"=>$image->hashName()
        ]);

        // 5.return response
        return response()->json([ //ketika berhasil
            "success" => true,
            "message" => "Resource added succesfully",
            "data" => $payment_method
        ], 201);
    }

    public function show(string $id){
        $payment_method = PaymentMethod::find($id);

        if(!$payment_method) {
            return response()->json([
                "succcess" => false,
                "message" => "Resource not found"
            ], 404);
        }

        return response()->json([ //ketika berhasil
            "success" => true,
            "message" => "Resource found",
            "data" => $payment_method
        ], 200);
    }

    public function update(Request $request, string $id){
        //cari data genre
        $payment_method = PaymentMethod::find($id);

        if(!$payment_method) {
            return response()->json([
                "succcess" => false,
                "message" => "Resource not found!"
            ], 404);
        };

        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "account_number" => "required|string|max:255",
            "Image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        ]);

        if($validator->fails()) {
            return response()->json([
                "succcess" => false,
                "message" => $validator->errors()
            ], 422);
        }

        // siapkan data yang ingin diupdate
        $data = [
            "name"=>$request->name,
            "account_number"=>$request->account_number,
        ];

        //...upload image
        if($request->hasFile('Image')){
            $image = $request->file('Image');
            $image->store('payment_methods','public');


            if($payment_method->photo){
                Storage::disk('public')->delete('books/'. $payment_method->photo);
            }

            $data['Image'] = $image->hashName();
        }

        //update data baru
        $payment_method->update($data);

        return response()->json([
            "succcess" => true,
            "message" => "Resource updated successfully!",
            "data" => $payment_method
        ], 200);

    }

    public function destroy(string $id){
        $payment_method =PaymentMethod::find($id);

        if(!$payment_method) {
            return response()->json([
                "succcess" => false,
                "message" => "Resource not found!",
            ], 404);
        };

        if($payment_method->photo){
            //delete image from storage
            Storage::disk('public')->delete('books/'. $payment_method->photo);
        }

        //delete data from db
        $payment_method->delete();

        return response()->json([
            "succcess" => true,
            "message" => "Resource deleted successfully",
        ], 200);
    }
}
