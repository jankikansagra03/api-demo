<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/test', function (Request $request) {
    return response()->json(['message' => 'API is working!']);
});

Route::apiResource('categories', CategoryController::class);

