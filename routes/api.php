<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Models\User;

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


Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/logout', function () {
    $user = User::where('id', auth()->user()->id)->with('tokens')->first();
    return $user->tokens()->delete();
});
Route::get('/profile', [AuthController::class, 'profile']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user/profile', function () {
        return response()->json(auth()->user());
    });
});


Route::group(['prefix' => 'books'], function () {
    Route::delete('/{book}', [BookController::class, 'destroy']);
    Route::get('/', [BookController::class, 'index']);
    Route::post('/', [BookController::class, 'store']);
    Route::get('/{book}', [BookController::class, 'show']);
    /*Route::resource('/', BookController::class);*/
    Route::post('/{book}/ratings', [RatingController::class, 'store']);
});
