<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();

        return response()->json([
            'data' => $categories,
            'message' => 'Categories fetched successfully',
            'status' => 'success',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'message' => 'Validation failed',
                'status' => 'error',
            ], 422);
        }

        $category = new Category();

        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;

        if ($category->save()) {
            return response()->json([
                'data' => $category,
                'message' => 'Category created successfully',
                'status' => 'success',
            ], 201);
        }

        return response()->json([
            'data' => null,
            'message' => 'Category could not be created',
            'status' => 'error',
        ], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'data' => null,
                'message' => 'Category not found',
                'status' => 'error',
            ], 404);
        }

        return response()->json([
            'data' => $category,
            'message' => 'Category fetched successfully',
            'status' => 'success',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'data' => null,
                'message' => 'Category not found',
                'status' => 'error',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'message' => 'Validation failed',
                'status' => 'error',
            ], 422);
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;

        if ($category->save()) {
            return response()->json([
                'data' => $category,
                'message' => 'Category updated successfully',
                'status' => 'success',
            ], 200);
        }

        return response()->json([
            'data' => null,
            'message' => 'Category could not be updated',
            'status' => 'error',
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'data' => null,
                'message' => 'Category not found',
                'status' => 'error',
            ], 404);
        }

        if ($category->delete()) {
            return response()->json([
                'data' => null,
                'message' => 'Category deleted successfully',
                'status' => 'success',
            ], 200);
        }

        return response()->json([
            'data' => null,
            'message' => 'Category could not be deleted',
            'status' => 'error',
        ], 500);
    }
}