<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductCollection::collection(Product::paginate(8));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $Validator = Validator::make($request->all(), [

            'name'          => 'required|max:255|unique:products',
            'description'   => 'required',
            'price'         => 'required|max:10',
            'stock'         => 'required|max:6',
            'discount'      => 'required|max:2',

        ]);

        if($Validator->passes()) {        
            $product = new Product;
            $product->name = $request->name;
            $product->detail = $request->description;
            $product->stock = $request->stock;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->save();
            return response([
                'data' => new ProductResource($product)
            ],201);
        }return response()->json(['key'=> 'error', 'value'=> 0 ,'data'=> $Validator->errors()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
