<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use File;
use Illuminate\Http\Request;

class productController extends Controller
{
    function ProductList(Request $request)
    {
        $userId = $request->header('userId');
        $products = Product::where('user_id', '=', $userId)->get();

        return response()->json([
            "status" => "success",
            "message" => "",
            "data" => $products
        ], 200);
    }

    function productById(Request $request)
    {
        $productId = $request->id;
        $userId = $request->header('userId');

        return Product::where('user_id', '=', $userId)->where('id', '=', $productId)->first();
    }

    function createProduct(Request $request)
    {
        $userId = $request->header('userId');

        try {
            $img = $request->file('img');
            $currentTime = time();
            $fileExtension = $img->extension();
            $imgName = "{$userId}-{$currentTime}.{$fileExtension}";
            $imgUrl = "uploads/{$imgName}";

            // Update to Database
            Product::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'unit' => $request->input('unit'),
                'img_url' => $imgUrl,
                'user_id' => $userId,
                'category_id' => $request->input('category_id'),
            ]);

            // Upload File
            $img->move(public_path('uploads'), $imgName);

            return response()->json([
                'status' => 'success',
                'message' => 'Product created successfully'
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Product creation failed'
            ], 400);
        }
    }

    function deleteProduct(Request $request)
    {
        try {
            $userId = $request->header('userId');
            $productId = $request->input('id');

            $product = Product::where('id', '=', $productId)
                ->where('user_id', '=', $userId);

            if ($product->count()) {
                $product->delete();
                File::delete($request->input('img_url'));

                return response()->json([
                    "status" => "success",
                    "message" => "product deleted successfully"
                ], 200);
            }

            throw new Exception("product not found", 404);

        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "product deleting failed"
            ], 400);
        }
    }

    function updateProduct(Request $request)
    {
        try {
            $userId = $request->header('userId');
            $product = Product::where('id', '=', $request->input('id'))
                ->where('user_id', '=', $userId);

            if ($product->count()) {

                if ($request->hasFile('img')) {

                    $img = $request->file('img');
                    $currentTime = time();
                    $fileExtension = $img->extension();
                    $imgName = "{$userId}-{$currentTime}.{$fileExtension}";
                    $imgUrl = "uploads/{$imgName}";

                    // Update Database
                    $product->update([
                        "name" => $request->input('name'),
                        "price" => $request->input('price'),
                        "img_url" => $imgUrl,
                        "unit" => $request->input('unit'),
                        "category_id" => $request->input('category_id')
                    ]);

                    // Save New Img
                    $img->move(public_path('uploads'), $imgName);

                    // Delete old Img
                    File::delete($request->input('old_img'));

                } else {

                   // Update Database
                    $product->update([
                        "name" => $request->input('name'),
                        "price" => $request->input('price'),
                        "unit" => $request->input('unit'),
                        "category_id" => $request->input('category_id')
                    ]);
                }
                return response()->json([
                    "status" => "success",
                    "message" => "product updated successfully"
                ], 200);
            }
            throw new Exception("Product not found", 404);

        } catch (Exception $e) {
            // return response()->json([
            //     "status" => "failed",
            //     "message" => "Updating product failed"
            // ], 400);
            return $e->getMessage();
        }
    }
}