<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        // Create a new product
        $product = new Product();
        $product->name =$request->name;
        $product->description =$request->description;
        $product->price =$request->price;
        $product->save();

        // Redirect back with success message
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Implement other CRUD methods (show, edit, update, destroy) as needed
}
