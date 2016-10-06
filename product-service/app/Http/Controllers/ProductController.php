<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;

use App\Http\Requests;

class ProductController extends Controller
{
    /**
     * Display a list of the resource.
     *
     */
    public function index()
    {
        return product::paginate();
    }

    public function store(Request $request)
    {
        return $product = product::create([
            'name' => $request->input('name')
        ]);
    }

    public function update(Request $request)
    {

    }
}
