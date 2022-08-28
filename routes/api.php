<?php
use App\Models\Meals;
use App\Models\Users;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UsersController;

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

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return Users::all();
});


Route::get('/meals', [MealsController::class, 'index']);
Route::post('/meals',  [MealsController::class, 'store']);
Route::put('/meals/{meal}', [MealsController::class, 'update']);
Route::delete('/meals/{meal}', [MealsController::class, 'delete']);

Route::post('/user', [UsersController::class, 'store']);

Route::post('/token/CreateToken/', [TokenController::class, 'index']);