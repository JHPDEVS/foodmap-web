<?php

use App\Http\Controllers\FoodsController;
use App\Http\Controllers\MenusController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/food/{food_name}', function ($food_name) {
    return Inertia::render('Food/food',['food_name'=>$food_name]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/food/돼지국밥', function ($food_name) {
    return Inertia::render('Food/food',['food_name'=>'돼지국밥']);
})->name('foodsearch');

Route::middleware(['auth:sanctum', 'verified'])->get('/food/show/{food_id}/{food_name}', function ($food_id,$food_name) {
return Inertia::render('Food/foodShow',['food_id'=>$food_id , 'food_name' => $food_name]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/recipe/{recipe_id}', function ($recipe_id) {
    return Inertia::render('Food/recipe',['recipe_id'=>$recipe_id]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/recipe/search/{recipe_name}', function ($recipe_name) {
    return Inertia::render('Food/recipeSearch',['recipe_name'=>$recipe_name]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/recipe/search/추천', function ($recipe_name) {
    return Inertia::render('Food/recipeSearch',['recipe_name'=>"추천"]);
})->name('recipesearch');
Route::middleware(['auth:sanctum', 'verified'])->get('/food/search/{food_name}', [FoodsController::class,'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('/food/index/{food_id}/{food_name}', [FoodsController::class,'show']);

Route::middleware(['auth:sanctum', 'verified'])->get('/menus', function () {
    return Inertia::render('Food/Menu');
})->name('menus');
Route::delete('/menu/delete', [MenusController::class,'delete']);
Route::post('/menu/save', [MenusController::class,'create']);
Route::middleware(['auth:sanctum', 'verified'])->get('/menu/show', [MenusController::class,'Index']);