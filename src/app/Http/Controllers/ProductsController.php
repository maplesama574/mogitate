<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductsRequest;

class ProductsController extends Controller
{
    //index表示
    public function index(Request $request)
    {   
    $products = Product::simplePaginate(6);
    $seasons = Season::all();
    $keyword = $request->input('keyword');
    $query=Product::query();

    if ($request->filled('keyword')) {
        $query->where(function($subQuery) use ($keyword) {
            $subQuery->where('name', 'like', "%{$keyword}%")
              ->orWhere('price', 'like', "%{$keyword}%")
              ->orWhere('description', 'like', "%{$keyword}%");
        });
    }

    if ($request->filled('category')) {
        if ($request->category === 'high-cost') {
            $query->orderBy('price', 'desc');
        } elseif ($request->category === 'low-cost') {
            $query->orderBy('price', 'asc');
        }
    }

    $products = $query->simplePaginate(6)->appends($request->all());

    $seasons = Season::all();
    return view('products.index', compact('products', 'seasons'));
    }

    public function create()
    {
    $product = new Product();
    $seasons = Season::all();
    return view('products.register', compact('product', 'seasons'));
    }

    //storeページ
    public function store(ProductsRequest $request)
    {
        $data=$request->all();

//画像保存処理        
        if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $data['image']= $path;
        }

        $product = Product::create([
        'name' => $data['name'],
        'price' => $data['price'],
        'description' => $data['text'],
        'image' => $data['image'],
    ]);

    if (isset($data['seasons'])) {
        $product->seasons()->sync($data['seasons']);
    }

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
            $product->update($request->only('name', 'price', 'description'));

        if ($request->has('seasons')) {
        $product->seasons()->sync($request->seasons);
        }else{
            $product->seasons()->sync([]);
        }

        $product=Product::findOrFail($productId);

        if ($request->hasFile('image')) {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
        Storage::disk('public')->delete($product->image);
        }
        $path = $request->file('image')->store('images', 'public');
        $data['image'] = $path;
        }

        $product->update($validated);
        
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