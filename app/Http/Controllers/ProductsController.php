<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        $products = Products::get();
        return view('products.index', [
            'products' => $products
        ]);
    }
    public function getProducts(Request $request)
    {        
        $products = Products::get();
        if(!empty($request->sort)){
            $products = Products::orderBy('id', $request->sort)->get();
        }
        if(!empty($request->category)){
            $products = Products::where('category', $request->category)->get();
        }
        if(!empty($request->sort) && !empty($request->category)){
            $products = Products::where('category', $request->category)->orderBy('id', $request->sort)->get();
        }
        return response()->json($products);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'price' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required',
        ]);        

        Products::create([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'category' => $request->category,
            'image' => $request->image,
        ]);

        return back();
    }
}
