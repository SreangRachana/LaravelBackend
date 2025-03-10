<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::all();
        return response()->json(['products' => $products]);
    }
    public function createProduct(Request $request)
    {
        $product = Product::create([
            'name' => $request['name'],
            'category_id' => $request['category_id'],
            'pricing' => $request['pricing'],
            'description' => $request['description'],
            'image' => $request['image'],
        ]);

        return response()->json(['message'=> $request['name'] . " has been added."]);
    }

    public function getProduct($productId) {
        $product = Product::findOrFail($productId);

        return response()->json(['category' => $product]);
    }

    public function updateProduct($productId, Request $request)
    {
        $product = Product::findOrFail($productId);

        $product->name = $request['name'];
        $product->category_id = $request['category_id'];
        $product->pricing = $request['pricing'];
        $product->description = $request['description'];
        $product->image = $request['image'];
        $product->save();

        return response()->json(["message" => "Product Updated!!!"]);
    }

    public function deleteProduct($productId) {
        $product = Product::findOrFail($productId);

        $product->delete();

        return response()->json(["message" => "Product Deleted!!!"]);
    }

    public function getProductsByCategory($categoryId) {
        $products = Product::where("category_id", $categoryId)->get();

        return response()->json(["products" => $products]);
    }
}
