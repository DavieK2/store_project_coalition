<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'product_name' => 'required',
            'qty'          => 'required|integer',
            'price'        => 'required|numeric'
        ]);

        Product::create( $data );

        return response()->json([ 'success' => true ]);
    }

    public function getProducts()
    {
        $products = Product::orderBy('created_at', 'desc')->get();

        return view('products.list', compact('products') );
    }

    public function update( Product $product )
    {
        $data = request()->validate([
            'product_name' => 'required',
            'qty'          => 'required',
            'price'        => 'required'
        ]);

        $product->update( $data );

        return response()->json([ 'success' => true ]);
    }
}
