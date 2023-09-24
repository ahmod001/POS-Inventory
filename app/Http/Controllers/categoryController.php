<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    function categoriesPage()
    {
        return view('pages.dashboard.category-page');
    }

    function categoryList(Request $request)
    {
        $userId = $request->header('userId');
        $categories = Category::where('user_id', '=', $userId)->get();

        return response()->json([
            "status" => "success",
            "message" => "",
            "data" => $categories
        ], 200);
    }

    function createCategory(Request $request)
    {
        try {
            $userId = $request->header('userId');
            Category::create([
                "user_id" => $userId,
                "name" => $request->input('name')
            ]);
            return response()->json([
                "status" => "success",
                "message" => "Category created successfully"
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "something went wrong"
            ], 400);
        }
    }

    function updateCategory(Request $request)
    {
        $userId = $request->header('userId');
        $categoryId = $request->input('id');

        try {
            $category = Category::where('id', '=', $categoryId)
                ->where('user_id', '=', $userId);

            if ($category->count() === 1) {
                $category->update([
                    "name" => $request->input('name')
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "Category updated successfully"
                ], 200);
            }
            throw new Exception("not found", 404);

        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Category updating failed"
            ], 400);
        }

    }

    function deleteCategory(Request $request)
    {
        $userId = $request->header('userId');
        $categoryId = $request->input('id');

        try {
            $category = Category::where('id', '=', $categoryId)
                ->where('user_id', '=', $userId);

            if ($category->count() === 1) {
                $category->delete();

                return response()->json([
                    "status" => "success",
                    "message" => "Category deleted successfully"
                ], 200);
            }
            throw new Exception("not found", 404);

        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Category deleting failed"
            ], 400);
        }
    }
}