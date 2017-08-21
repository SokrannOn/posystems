<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use Auth;
use Illuminate\Support\Facades\Input;

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
        $categories = Category::pluck('name','id')->all();
        return view('admin.product.index',compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id')->all();
        return view('admin.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'product_code' => 'required|string',
            'product_barcode' => 'required|string',
            'name' => 'required|string',
            'category_id' => 'required|string',
        ]);
            $product = new Product;
            $product->product_code = Input::get("product_code");     
            $product->product_barcode = Input::get("product_barcode");
            $product->name = Input::get("name");     
            $product->description = Input::get("description");
            $product->category_id = Input::get("category_id"); 
            $product->qty = 0;   
            $product->user_id = Auth::user()->id;
            $product->save();
            return redirect()->route('products.index')->with('message','This new product has been created successfully!');
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
        $product = Product::findOrFail($id);
        $categories = Category::pluck('name','id')->all();
        return view('admin.product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_code' => 'required|string',
            'product_barcode' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|string',
        ]);
            $product = Product::findOrFail($id);
            $product->product_code = Input::get("product_code");     
            $product->product_barcode = Input::get("product_barcode");
            $product->name = Input::get("name");     
            $product->description = Input::get("description");
            $product->category_id = Input::get("category_id"); 
            $product->user_id = Auth::user()->id;
            $product->save();
            return redirect()->route('products.index')->with('message','This district has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('message','This product has been deleted successfully!');
    }
}
