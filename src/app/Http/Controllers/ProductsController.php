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
    $query = Product::query();

    if ($request->filled('keyword')) {
        $keyword = $request->input('keyword');
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

    $products = $query->paginate(6)->appends($request->all()); // paginate() に変更
    $seasons = Season::all();

    return view('products.index', compact('products'));
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
    $data = $request->all();

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    $product = Product::create([
        'name' => $data['name'],
        'price' => $data['price'],
        'description' => $data['text'],
        'image' => $imagePath,
    ]);

    $seasonIds = array_filter(array_map('intval', $request->input('seasons', [])));
    $product->seasons()->sync($seasonIds);

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
        $validated = $request->validate([
    'name' => 'required|string|max:255',
    'price' => 'required|numeric',
    'description' => 'required|string',
    'seasons' => 'required|array'
]);

$product = Product::findOrFail($productId);
$product->update($validated);

$seasonIds = array_filter(array_map('intval', $request->input('seasons', [])));
$product->seasons()->sync($seasonIds);

        if ($request->hasFile('image')) {
    if ($product->image && Storage::disk('public')->exists($product->image)) {
        Storage::disk('public')->delete($product->image);
    }

    $path = $request->file('image')->store('products', 'public');

    $product->update(['image' => $path]);
}

        
    return redirect()->route('products.index');
        }
    
    //データ編集処理
    public function edit($productId)
{
    $product = Product::with('seasons')->findOrFail($productId);
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

return redirect()->route('products.index');
}
    }