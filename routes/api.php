<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MasterItemController;

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


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('items', [MasterItemController::class, 'index']);
Route::post('items', [MasterItemController::class, 'store']);
Route::get('items/{id}', [MasterItemController::class, 'show']);
Route::get('items/{id}/edit', [MasterItemController::class, 'edit']);
Route::put('items/{id}/edit', [MasterItemController::class, 'update']);
Route::put('items/{id}/delete', [MasterItemController::class, 'destroy']);