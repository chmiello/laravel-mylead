<?php

namespace App\Http\Controllers\Manager;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('manager/products/index', compact('products'));
    }

    public function create()
    {
        $product = new Product();
        return view('manager/products/create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'prices.*.label' => 'required',
            'prices.*.price' => 'required',
            'prices.*.selected' => 'required',
        ]);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->save();

        $pricesCollection = $product->prices;

        foreach ($request->input('prices') as $index => $price) {
            $modelPrice = $pricesCollection->find(array_get($price, 'id'), new Price());
            $modelPrice->label = $price['label'];
            $modelPrice->price = $price['price'];
            $modelPrice->selected = ($price['selected'] == 'true' || $price['selected'] == 1) ? true : false;
            $modelPrice->product_id = $product->id;
            $modelPrice->save();

            $pricesCollection = $pricesCollection->except($modelPrice->id);
        }

        foreach ($pricesCollection as $item) {
            $item->delete();
        }

        return redirect(route('products.list'));

    }

    public function edit(Product $product)
    {
        return view('manager/products/edit', compact('product'));
    }
    
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }
}
