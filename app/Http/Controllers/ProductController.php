<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    public function product(){
        $subcategory =Subcategory::orderBy('id','DESC')->with('category')->get();
        // dd($subcategory);
        return view('layouts.saveproduct',compact('subcategory'));
    }

    public function saveproduct(Request $request){
        //   dd($request->all());
        $validator=Validator::make($request->all(),[
            'title'=>'required|string',
            'description'=>'required',
            'price'=>'required|numeric',
            'subcategory_id' =>'required',
            'thumbnail'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if($validator->passes()){
            $input['thumbnail'] = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('images'), $input['thumbnail']);
           
            $data=[
                'title'=>$request->title,
                'description' =>$request->description,
                'subcategory_id'=>$request->subcategory_id,
                'price'=>$request->price,
                'thumbnail'=>$input['thumbnail']
            ];
            $status=Product::create($data);
            if($status){
                return response()->json([
                    'success' => 'Product added successfully',
                    // 'uploaded_image' => '<img src="/images/' . $input['thumbnail'] . '" class="img-thumbnail" width="300" />',
                    'class_name'=>' alert-success'
                ]);
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function viewproducts(){
        
        $allProducts=Product::orderBy('id','DESC')->with('subcategory')->get();
        // dd($allProducts);
        $allcategories=Category::orderBy('id','DESC')->get();
        $allsubcategories=Subcategory::orderBy('id','DESC')->get();
        return view('layouts.allProducts',compact('allProducts','allcategories','allsubcategories'));
    }

    public function bycategory($id){
        $allcategories=Category::orderBy('id','DESC')->get();
        $allsubcategories=Subcategory::orderBy('id','DESC')->get();
        // $productThroughCategory=Category::where('id',$id)->orderBy('id','DESC')->with('products')->get();
        $productThroughCategory=Category::where('id',$id)->orderBy('id','DESC')->with('products')->get();
        // dd($productThroughCategory);
        
        return view('layouts.categoryProducts',compact('allsubcategories','productThroughCategory','allcategories'));
    }
    public function bysubcategory($id){
        $allcategories=Category::orderBy('id','DESC')->get();
        $allsubcategories=Subcategory::orderBy('id','DESC')->get();
        $productThroughCategory=Category::where('id',$id)->orderBy('id','DESC')->with('products')->get();
        
        $productsThroughsubcategories=Subcategory::where('id',$id)->orderBy('id','DESC')->with('productsbysubcat')->get();
        
        // dd($productsThroughsubcategories);
        return view('layouts.filterBysubCategory',compact('allsubcategories','productThroughCategory','allcategories','productsThroughsubcategories'));
    }


    public function deleteProduct($id){
        $deleteProduct=Product::find($id);
        // dd($deleteProduct);
        if($deleteProduct){
            $deleteProduct->delete();
            return response()->json([
                'message' =>"deleted successfully"
                
            ]);
            
        }else{
            echo "Product not found";
        }
    }

}
