<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        $products = $query->with('company')->get();
        $companies = Company::all();

        return view('products.index', compact('products', 'companies'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $product = new Product([
                'company_id'   => $request->company_id,
                'product_name' => $request->product_name,
                'price'        => $request->price,
                'stock'        => $request->stock,
                'comment'      => $request->comment,
            ]);

            if ($request->hasFile('img_path')) {
                $filename = $request->img_path->getClientOriginalName();
                $filePath = $request->img_path->storeAs('products', $filename, 'public');
                $product->img_path = $filePath;
            }

            $product->save();
            return redirect('products')->with('success', '商品が登録されました');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    public function edit(Product $product)
    {
        $companies = Company::all();
        return view('products.edit', compact('product', 'companies'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('products', 'public');
            $product->img_path = $imagePath;
        }

        $product->update($request->only([
            'product_name', 'company_id', 'price', 'stock', 'comment'
        ]));

        return redirect()->route('products.show', $product->id)->with('success', '商品情報を更新しました！');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/products');
    }
}
