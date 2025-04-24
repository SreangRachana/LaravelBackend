<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories, 'message' => 'success']);
    }
    public function createCategory(Request $request)
    {
        $category = Category::create(['name' => $request['name']]);
        return response()->json(['message'=> $request['name'] . " has been added."]);
    }

    public function getCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        return response()->json(['category' => $category, 'message' => 'success']);
    }

    public function updateCategory($categoryId, Request $request)
    {
        $category = Category::findOrFail($categoryId);

        $category->name = $request['name'];
        $category->save();

        return response()->json(["message" => "Category Updated!!!"]);
    }

    public function deleteCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $category->delete();

        return response()->json(["message" => "Category Deleted!!!"]);
    }

    public function getLimitedCategories($limit)
    {
        // Assuming you want to get the specified number of categories
        $categories = Category::limit($limit)->get();
        return response()->json($categories);
    }


}
