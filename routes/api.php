<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FirstTableController;
use App\Http\Controllers\SecondTableController;
use App\Http\Controllers\CsrfCookieController;

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

Route::post('/store-in-first-table', [FirstTableController::class, 'store']);
Route::get('/show-from-first-table', [FirstTableController::class, 'show']);
Route::get('/edit-from-first-table/{id}', [FirstTableController::class, 'edit']);
Route::patch('/update-from-first-table', [FirstTableController::class, 'update']);
Route::delete('/destroy-from-first-table', [FirstTableController::class, 'destroy']);

Route::post('/store-in-second-table', [SecondTableController::class, 'store']);
Route::get('/show-from-second-table', [SecondTableController::class, 'show']);
Route::get('/edit-from-second-table/{id}', [SecondTableController::class, 'edit']);
Route::patch('/update-from-second-table', [SecondTableController::class, 'update']);
Route::delete('/destroy-from-second-table', [SecondTableController::class, 'destroy']);

Route::get('/refresh-csrf-token', [CsrfCookieController::class, 'show']);
