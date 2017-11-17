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
        return view('manager/products/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'prices.*.description' => 'required',
            'prices.*.value' => 'required',
            'prices.*.currentprice' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->save();

        foreach ($request->input('prices') as $index => $price) {
            $modelPrice = new Price();
            $modelPrice->label = $price['description'];
            $modelPrice->price = $price['value'];
            $modelPrice->selected = ($index == $request->input('active'));
            $modelPrice->product_id = $product->id;
            $modelPrice->save();
        }

        return redirect(route('products.list'));

    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }
}
