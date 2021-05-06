<?php

namespace App\Http\Controllers\API;

use App\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function CreateProduct(Request $request){
        $array = $request->except('api_token');
        $create = Products::create($array);
        if ($create) {
            $data['success'] = "1";
            $data['message'] = "Product created Successfully.";
            $data['data'] = (["product"=>$create]);
        } else {
            $data['success'] = "0";
            $data['message'] = "Product not created.";
            $data['data'] = "";
        }

        return response()->json($data);
    }

    public function UpdateProduct(Request $request){
        $array = $request->except('api_token','merchant_id','product_id');
        $update = Products::where('id',$request->product_id)->update($array);
        if ($update) {
            $product = Products::find($request->product_id);
            $data['success'] = "1";
            $data['message'] = "Product updated Successfully.";
            $data['data'] = (["product"=>$product]);
        } else {
            $data['success'] = "0";
            $data['message'] = "Product not updated.";
            $data['data'] = "";
        }

        return response()->json($data);
    }

    public function DeleteProduct(Request $request){
        $delete = Products::find($request->product_id)->delete();
        if ($delete) {
            $data['success'] = "1";
            $data['message'] = "Product deleted Successfully.";
            $data['data'] = "";
        } else {
            $data['success'] = "0";
            $data['message'] = "Product not deleted.";
            $data['data'] = "";
        }

        return response()->json($data);
    }

    public function ProductList(Request $request){
        $products = Products::where('merchant_id',$request->merchant_id)->get();
        foreach ($products as $key => $value) {
            $array[] = array(
                'id' => $value->id,
                'name' => $value->name,
                'description' => $value->description,
                'price' => $value->price,
                'quantity' => $value->quantity,
                'status' => $value->status,
                'created_at' => date('Y-m-d H:i:s',strtotime($value->created_at)),
                'updated_at' => date('Y-m-d H:i:s',strtotime($value->updated_at)),
            );
        }
        if (count($products) > 0) {
            $data['success'] = "1";
            $data['message'] = "products fetched successfully.";
            $data['data'] = array('productinfo' => $array);
        } else {
            $data['success'] = "0";
            $data['message'] = "There are no products.";
            $data['data'] = "";
        }
        return response()->json($data);
    }


}
