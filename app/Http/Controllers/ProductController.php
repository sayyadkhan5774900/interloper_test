<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $product = Product::create([
            'name'=> $request->name,
            'description'=> $request->description,
            'price'=> $request->price,
            'quantity'=> $request->quantity,
            'product_code'=> $this->generateTID(),
        ]);
        if($request->hasFile('file')){
            $image = $request->file('file');
            $name = $product->id.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $product->product_image = $name;
            $product->save();
        }
        return redirect()->route('products.index')->with('success','product added successfully');
    }


    public function generateTID()
    {
        $trackingid = rand(100000, 999999);
        return $this->checkTID($trackingid);
    }
    public function checkTID($trackingdid)
    {
        $verifytrackingid = Product::where('product_code', $trackingdid)->get();
        if (count($verifytrackingid) == 0) {
            return $trackingdid;
        } else {
            return $this->generateTID();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    
     public function edit($id)
     {
         $product = Product::findOrFail($id);
     
         return view('products.edit', compact('product'));
     }
     
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product)
    {
        $product->update([
            'name'=> request('name'),
            'description'=> request('description'),
            'price'=> request('price'),
            'quantity'=> request('quantity'),
        ]);
        return redirect()->route('products.index')->with('success','product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('success','product deleted successfully');
    }
}
