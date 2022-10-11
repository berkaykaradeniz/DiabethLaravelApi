<?php
use App\Models\Meals;
use App\Models\Users;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DuserController;


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

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/meals', [MealsController::class, 'index']);
    Route::post('/meals',  [MealsController::class, 'store']);
    Route::put('/meals/{meal}', [MealsController::class, 'update']);
    Route::delete('/meals/{meal}', [MealsController::class, 'delete']);
    Route::post('/meals/getUserMeal',  [MealsController::class, 'get']);
    
    Route::post('/users', [DuserController::class, 'store']);//Save User Data
    Route::get('/users/{id}',  [DuserController::class, 'get']);//Get User Data
    Route::post('/users/login',  [DuserController::class, 'login']);//User Can Login
    Route::put('/users/{user}', [DuserController::class, 'update']);//Edit User Data
    Route::delete('/users/{user}', [DuserController::class, 'delete']);//Delete User Data
});


Route::post('/token/CreateToken/', [TokenController::class, 'index']);
