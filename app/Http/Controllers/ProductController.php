<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function allProdcuts()
    {
        $products = product::orderBy('created_at', 'desc')->paginate(10);
        return view('products.products-list', compact('products'));
    }
    public function addProducts()
    {
        $res['title'] = 'Products';
        $res['html'] = view('products.add-products')->render();
        return response()->json($res);
    }
    public function editProducts(Request $request, $product_id = null)
    {
        $products = Product::find($product_id);
        $res['title'] = 'Products';
        $res['html'] = view('products.add-products', compact('products'))->render();
        return response()->json($res);
    }

    public function storeProducts(Request $request, $product_id = null)
    {
        $products = ($request->product_id) ? Product::find($request->product_id) : new Product;
        if ($request->post()) {
            $rules = $request->validate([
                "name" => "required|unique:products",
                "description" => "required",
                "price" => "required",
                "quantity" => "required",
            ]);

            if ($rules) {
                dd($rules);
                $products->name = $request->name;
                $products->description = $request->description;
                $products->price = $request->price;
                $products->quantity = $request->quantity;
                $products->save();
                return redirect()->back()->with('success', 'Product submitted successfully.');
            }
        }
    }

    public function deleteProducts($product_id)
    {
        $products = Product::find($product_id);
        $products->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
