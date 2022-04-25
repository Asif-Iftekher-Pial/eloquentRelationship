<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function saveCategory(Request $request){
        $validator=Validator::make($request->all(),[
            'title'=>'required|string',
            'description'=>'required'
        ]);
        if($validator->passes()){
            $data=[
                'title'=>$request->title,
                'description' =>$request->description
            ];
            $status=Category::create($data);
            if($status){
                return response()->json([
                    
                    'success' => 'Category added successfully',
                    'class_name'=>' alert-success'
                ]);
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function subcat(){
         $category = Category::orderBy('id','DESC')->get();
        // dd($category);

        return view('layouts.subcategory',compact('category'));
    }

    public function savesubCategory(Request $request){
        $validator=Validator::make($request->all(),[
            'title'=>'required|string',
            'description'=>'required',
            'category_id'=>'required'
        ]);
        if($validator->passes()){
            $data=[
                'title'=>$request->title,
                'description' =>$request->description,
                'category_id'=>$request->category_id
            ];
            $status=Subcategory::create($data);
            if($status){
                return response()->json([
                    
                    'success' => 'Category added successfully',
                    'class_name'=>' alert-success'
                ]);
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
}
