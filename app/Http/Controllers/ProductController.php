<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $product = new Product();
            $product->name = $request->product_name;
            $product->details = $request->product_details;
            $product->save();   
        }
    }

    public function list()
    {
        $products = Product::all();
        return view('table',compact('products'));
        
    }

    public function edit(Request $request)
    {
        if ($request->ajax()) {
            $product =  Product::findOrFail($request->product_id);
            $product->name = $request->product_name;
            $product->details = $request->product_details;
            $product->update();   
        }
    }

    public function delete(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->delete();
    }
}
