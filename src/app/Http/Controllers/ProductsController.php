<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;

class ProductsController extends Controller
{
    //index表示
    public function index()
    {
        $products = Product::all();
        $seasons = Season::all();
        return view('products.index', compact('products', 'seasons'));
    }
    public function create()
    {
        return view('products.create');
    }
}
