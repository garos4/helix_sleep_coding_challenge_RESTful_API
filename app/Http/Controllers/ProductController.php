<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\ImageOperations;
use App\Traits\Response;
use App\Traits\SaveProductDetails;
use App\Traits\ValidationEngine;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    use ValidationEngine, ImageOperations, Response, SaveProductDetails;


    //get list of all products
    public function index()
    {
        try {
            $products = Product::all();

            return $this->successResponse($products);
        } catch (Exception $error) {

            return $this->errorResponse($error->getMessage(), 200);
        }
    }


    //get product by id
    public function show($id)
    {
        if (!$data = Product::find($id)) {
			return $this->notFoundResponse();
		}
	
		return $this->successResponse($data);
    }

    //create a new product
    public function store(Request $request)
    {
        return $this->saveDetails(new Product(), $request);
    }

    //update product details
    public function update(Request $request, $id)
    {

        if (!$product = Product::find($id)) {
            return $this->notFoundResponse();
        }

        return $this->saveDetails($product, $request);
    }

    //delete product
    public function destroy($id)
    {
	
		if (!$data = Product::find($id)) {
			return $this->notFoundResponse();
		}
	
		$data->delete();

		return $this->deleteResponse('Product deleted');
    }
}
