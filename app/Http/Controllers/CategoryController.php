<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    //
    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        
        if (!$validator->fails()){

            $data=$request->all();

            $category = Category::create([
                'name' => $data['name'],
            ]);

            if($category) {
                return response("Category saved successfully", 201);
            } else {
                return response("Could not save category");
            }

        }else{

            return $validator->errors();

        }
    }

    public function view() {
        $categories = Category::get();
        return response($categories, 201);
    }

    public function edit(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'category_id' => 'required|numeric'
        ]);

        if (!$validator->fails()){

            $data=$request->all();

            $category = Category::where('id', $data['category_id'])->update([
                'name' => $data['name'],
            ]);

            if($category) {
                return response("Category Updated", 201);
            } else {
                return response("Category not Updated");
            }

        }else{

            return $validator->errors();

        }

    }

    public function delete($category_id) {
        $category_delete = Category::where('id', $category_id)->delete();

        if($category_delete) {
            return response("Category Deleted", 201);
        } else {
            return response("Category not Deleted");
        }
    }
}
