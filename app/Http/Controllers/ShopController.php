<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $count = 0;

        if (auth()->check()) {
            $count = auth()->user()->cart()->count();
        }

        return view('shop', compact('products', 'count'));
    }
}
