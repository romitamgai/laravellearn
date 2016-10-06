<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\description;
use App\product;
use App\Http\Requests;

class ProductDescriptionController extends Controller
{
    public function index($productId){
        return description::ofProduct($productId)->paginate();
    }

    public function store($productId, Request $request){
        $product = product::findOrFail($productId);

        $product->descriptions()->save(new description([
            'body'=> $request->input('body')
        ]));
        return $product->descriptions;
    }
}
