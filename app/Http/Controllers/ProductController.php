<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            
        return ProductResource::collection(Product::orderBy('id', 'desc')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        
        $validatedProduct = $request->validated();
        $path = $request->file('image')->storePublicly('public/images');
        $validatedProduct["image"] = $path;
        $product = Product::create($validatedProduct);

        $attributes = json_decode($request->input('attributes'), true);
        $product->attributes()->createMany($attributes);
        return response(new ProductResource($product) , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        
        $data = $request->validated();
        $path = $request->file('image')->storePublicly('public/images');
        $data["image"] = $path;
        $product->update($data);

        return response(new ProductResource($product) , 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response("", 204);
    }
}
