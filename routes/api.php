<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\NewsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Routes for Categories
Route::apiResource('categories', CategoryController::class);

// API Routes for News
Route::apiResource('news', NewsController::class);

/*
|--------------------------------------------------------------------------
| Additional News Routes
|--------------------------------------------------------------------------
*/
Route::prefix('news')->group(function () {
    // Get news by category
    Route::get('category/{categoryId}', [NewsController::class, 'getByCategory']);
    
    // Search news
    Route::post('search', [NewsController::class, 'search']);
});