<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->sort === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'desc') {
            $query->orderBy('price', 'desc');
        }

        $products = $query->paginate(6)->appends($request->query());
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    // ✅ 新規登録（複数季節）
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->seasons = $request->seasons; // castsで配列→json保存

        if ($request->hasFile('image')) {
            $product->image_path = $request->file('image')->store('products', 'public');
        }

        $product->save();
        return redirect()->route('products.index', []);
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // ✅ 更新（画像削除・差替え対応）
    public function update(UpdateProductRequest $request, Product $product)
{
    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->seasons = $request->has('seasons') ? $request->seasons : [];

    if ($request->boolean('delete_image') && $product->image_path) {
        Storage::disk('public')->delete($product->image_path);
        $product->image_path = null;
    }

    if ($request->hasFile('image')) {
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        $product->image_path = $request->file('image')->store('products', 'public');
    }

    $product->save();
    
    // ✅ クエリリセット付きでリダイレクト
    return redirect()->route('products.index', [])->with('success', '商品を更新しました');
}


    public function destroy(Product $product)
    {
        // 画像も掃除
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }
}