<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserProduct;
use App\Traits\Response;

class UserProductController extends Controller
{
    //
    use Response;

    public function attach($id)
    {

        if (!$product = Product::find($id)) {
            return $this->notFoundResponse();
        }

        $user_product = UserProduct::where('product_id', $id)
            ->where('user_id', auth('api')->user()->id)
            ->first();

        if ($user_product) {
            return $this->alreadyExistsResponse();
        }

        $user_product = new UserProduct();
        $user_product->product_id = $product->id;
        $user_product->save();

        return $this->successResponse($user_product);
    }

    public function remove($id)
    {
        $user_product = UserProduct::where('product_id', $id)
            ->where('user_id', auth('api')->user()->id)
            ->first();

        if (!$user_product) {
            return $this->notFoundResponse();
        }

        $user_product->delete();

        return $this->deleteResponse('Removed successfully');
    }

    public function userProducts()
    {
        $user = auth('api')->user()->id;
        $user_products = Product::whereHas('attached_user', function ($query) use ($user) {
                $query->where('user_id', $user);
            })
            ->get();

        return $this->successResponse($user_products);
    }
}
