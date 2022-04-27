<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EditproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $dataProduct=  Product::find($id);
        return response()->json([
            'status'=>200,
            'currentProduct'=> $dataProduct
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,$id)
    {

        $validator=Validator::make($request->all(),[
            'title'=>'required|string',
            'description'=>'required',
            'price'=>'required|numeric',
            'subcategory_id' =>'required',
            'thumbnail'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        

        if($validator->passes()){

            $data= Product::find($id);
            $currentfile= $data->thumbnail;
            @unlink(public_path('images/'.$currentfile));
            // $input['thumbnail'] = time() . '.' . $request->thumbnail->extension();
            // $thumbnail=  $request->thumbnail->move(public_path('images'), $input['thumbnail']);
            // @unlink(public_path('images/' . $currentfile));
            if ($request->file('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/'), $filename);
            }
          $status=$data->update([
                'title'=>$request->title,
                'description' =>$request->description,
                'subcategory_id'=>$request->subcategory_id,
                'price'=>$request->price,
                'thumbnail'=>$filename
            ]);
            if($status){
                return response()->json([
                    'status'=>200
                ]);
            }
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
