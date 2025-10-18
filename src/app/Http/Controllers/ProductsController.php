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
    public function store(Request $request)
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
        if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $request->merge(['image' => $path]);
        }

        $product = Product::create($REQUEST->only('name', 'price', 'image', 'text'));

         $product->seasons()->sync($request->seasons);

        return redirect()->route('products.index');
    }
    //詳細ページ
    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.show', compact('product'));
    }

    //更新処理
        public function update(Request $request, $productId)
        {
            $product=Product::findOrFail($productId);
            $product->update($request->only('name', 'price', 'text'));

        if ($request->has('seasons')) {
        $product->seasons()->sync($request->seasons);
        }

        if ($request->hasFile('image')) {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
        Storage::disk('public')->delete($product->image);
        }
        $path = $request->file('image')->store('images', 'public');
        $product->update(['image' => $path]);
    }
            
    return redirect()->route('products.index');
        }
    
    //データ編集処理
    public function edit($productId)
{
    $product = Product::findOrFail($productId);
    $seasons = Season::all();
    return view('products.edit', compact('product', 'seasons'));
}


    //削除処理
        public function destroy($productId){
            $product = Product::findOrFail($productId);
        if ($product->image && Storage::disk('public')->exists($product->image)) {
        Storage::disk('public')->delete($product->image);
}
$product->delete();

        }
    }