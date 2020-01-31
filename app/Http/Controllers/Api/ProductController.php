<?php
/**
 * Product Controller
 * PHP version 7.1
 * 
 * @category Controller
 * @package  RestAPI
 * @author   By Swadi <muath.ye@gmail.com>
 * @license  Swadi 
 * @link     specify.link.here
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as Base;
use Illuminate\Http\Request;
use App\Models\Product;
use Validator;
use App\Http\Resources\Product as ProductResource;

/**
 * Product Controller
 * PHP version 7.1
 * 
 * @category Controller
 * @package  RestAPI
 * @author   By Swadi <muath.ye@gmail.com>
 * @license  Swadi 
 * @link     specify.link.here
 */
class ProductController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        
        return $this->sendResponse(
            ProductResource::collection($products),
            'Products retrieved successfully!'
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = $this->validateProduct($request);
        
        if ($validator->fails()) {

            return $this->sendError(
                'Validation Error.', 
                $validator->errors()
            );

        }

        $product = Product::create($input);

        return $this->sendResponse(
            new ProductResource($product),
            'Product created successfully!'
        );

    }

    /**
     * Display the specified resource.
     *
     * @param int $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return $this->sendError('Product not found!');
        }

        return $this->sendResponse(
            new ProductResource($product),
            'Product retrieved successfully!'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request 
     * @param \App\Models\Product      $product 
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();

        $validator = $this->validateProduct($request);

        if ($validator->fails()) {
            return $this->sendError(
                'Validation Error!',
                $validator->errors()
            );
        }

        $product->name    = $input['name'];
        $product->details = $input['details'];
        $product->save();

        return $this->sendResponse(
            new ProductResource($product),
            'Product updated successfully!'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product 
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->sendResponse(
            new ProductResource($product),
            'Product deleted successfully!'
        );
    }

    ///////////////////////////////////////////////////////////////////////////////

    /**
     * Validate user input
     * 
     * @param \Illuminate\Http\Request $request 
     * 
     * @return boolean 
     */
    public function validateProduct(Request $request)
    {
        return Validator::make(
            $request->all(),
            [
                'name'       => 'required',
                'details'    => 'required',
            ]
        );
    }
}
