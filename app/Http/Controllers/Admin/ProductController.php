<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = product::latest('id')->paginate(10);
        return view('admin.product.productList',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.productAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name'=>'required|max:200',
            'cost_price'=>'required',
            'selling_price'=>'required'
        ]);

        // return $request->all();
        $data = new product;
        $data->product_name = $request->product_name;
        $data->cost_price = $request->cost_price;
        $data->selling_price = $request->selling_price;
        $data->save();
        $request->session()->flash('successMsg','Product Added Successfully.');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        return view('admin.product.productEdit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {   
        $validatedData = $request->validate([
            'product_name'=>'required|max:200',
            'cost_price'=>'required',
            'selling_price'=>'required'
        ]);       
        $product->product_name = $request->product_name;
        $product->cost_price = $request->cost_price;
        $product->selling_price = $request->selling_price;
        $product->update();
        $request->session()->flash('successMsg','Product Updated Successfully.');
        return redirect()->route('product.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('successMsg',"Product Deleted Successfully.");

    }
}
