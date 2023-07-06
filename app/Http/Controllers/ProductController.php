<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
//   This function is to View the Product list
    public function index(){
        $data['products'] = Product::get();
        return view('product_list',$data);
    }
//   This function is to View the Product from
    public function add_product(){
        return view('product_form');
    }
//   This function is to Save Data Product from
    public function save_product(Request $request){
        if ($request->file('image')){
            $name = time() . rand(1, 100) . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('product_images'), $name);
        }
        Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'description'=>$request->description,
            'image'=>$name
        ]);
        return redirect()->back();
    }
//   This function is to View edit Product from
    public function edit_product($id){
        $data['product'] = Product::where('id',$id)->first();
        return view('edit_product',$data);
    }
//   This function is to Update Data Product from
    public function update_product(Request $request){
        $product = Product::where('id',$request->id)->first();
        if ($request->file('image')){
            unlink(public_path('product_images/').$product->image);
            $name = time() . rand(1, 100) . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('product_images'), $name);
        }else{
            $name = $product->image;
        }
        $product->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'description'=>$request->description,
            'image'=>$name
        ]);
        return redirect('product_list');
    }
//   This function is to Delete Data from Product
    public function delete_product($id){
        $product = Product::where('id',$id)->first();
        unlink(public_path('product_images/').$product->image);
        $product->delete();
        return redirect('product_list');
    }
}
