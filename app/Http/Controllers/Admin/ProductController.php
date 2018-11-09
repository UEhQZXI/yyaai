<?php

namespace App\Http\Controllers\Admin;

use App\Models\Store\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.product.index')->with('products', $products);
    }

    public function store()
    {
        return view('admin.product.store');
    }

    public function update($product)
    {
        $product = Product::where('id', $product)->with('category')->first();

        if (!$product) {
            return back();
        }

        return view('admin.product.update')->with('product', $product);
    }
}
