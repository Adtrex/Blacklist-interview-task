<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Validator;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    //
    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'category_id' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);
        
        if (!$validator->fails()){

            $data=$request->all();

            $category = Product::create([
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'amount' => $data['amount']
            ]);

            if($category) {
                return response("Product saved successfully", 201);
            } else {
                return response("Could not save Product");
            }

        }else{

            return $validator->errors();

        }
    }

    public function view() {
        $products = Product::get();
        return response($products, 201);
    }

    public function edit(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'category_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'product_id' => 'required|numeric'
        ]);

        if (!$validator->fails()){

            $data=$request->all();

            $category = Product::where('id', $data['product_id'])->update([
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'amount' => $data['amount']
            ]);

            if($category) {
                return response("Product Updated", 201);
            } else {
                return response("Product not Updated");
            }

        }else{

            return $validator->errors();

        }

    }

    public function delete($product_id) {
        $product_delete = Product::where('id', $product_id)->delete();

        if($product_delete) {
            return response("Product Deleted", 201);
        } else {
            return response("Product not Deleted");
        }
    }

    public function download() {
        $download = Excel::download(new ProductsExport, 'products.csv');

        if($download) {
            return response("Products Downloaded", 201);
        } else {
            return response("Products not Downloaded");
        }
    }
}
