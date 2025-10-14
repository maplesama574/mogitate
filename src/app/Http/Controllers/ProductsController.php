<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        return view('products.register');
    }
    public function store(Request $request, $productId)
    {
        $request->validate([
            'name' => 'required|string', 
            'price' => 'required|numeric|min:0|max:10000',
            'image'=>'required|image|mimes:jpg,png',
            'seasons'=>'required|array', 
            'seasons.*'=>'exists:seasons,id',
            'text'=>'required|string|max:120'
        ]);

//画像保存処理

        $oldImage = $product->image;
        
        if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $request->merge(['image' => $path]);

        if ($oldImage && Storage::disk('public')->exists($oldImage))
        {
            Storage::disk('public')->delete($oldImage);
        }
        }

        $product->update($request->only('name', 'price', 'image', 'text'));

         $product->seasons()->sync($request->seasons);

        return redirect()->route('products.index');
    }
    }