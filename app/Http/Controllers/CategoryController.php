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
        // fetch all records from the categories table
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'message' => 'Validation failed',
                'status' => 'error',
            ], 422);
        }

        $category1 = new Category();
        $category1->name = $request->name;
        $category1->description = $request->description;
        $category1->status = $request->status;
        if ($category1->save()) {

            return response()->json([
                'data' => $category1,
                'message' => 'Category created successfully',
                'status' => 'success',
            ], 201);

            // insert data into the categories table
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // fetch a single record from the categories table based on the provided ID
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // update a record in the categories table based on the provided ID
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete a record from the categories table based on the provided ID
    }
}
