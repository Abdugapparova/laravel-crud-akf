<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // paginate(number of products what we want to see in one page)
        $products=Products::latest()->paginate(5);

        return view('products.index', compact('products'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the input
        $request->validate([
            'name' =>'required',
            'detail' =>'required'
        ]);

        //create a new product in the database
        Products::create($request->all());

        //redirect the user and send friendly message 
        return redirect()->route('products.index')->with('success','Product created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $Products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
        return view('products.show',compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $Products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $Products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $product)
    {
        //validate the input
        $request->validate([
            'name' =>'required',
            'detail' =>'required'
        ]);

        //update a new product in the database
        $product->update($request->all());

        //redirect the user and send friendly message 
        return redirect()->route('products.index')->with('success','Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $Products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        //delete the product
        $product->delete();

        //redirect the user and display succes message
        return redirect()->route('products.index')->with('success','Product deleted successfully!');

    }
}
