<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\MetadataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('files/{object_name}', [FileController::class, 'store'])->where('object_name', '[^?!\s].{0,}');
Route::resource('files', FileController::class);
Route::apiResource('files.metadata', MetadataController::class);

