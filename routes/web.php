<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get("/", [App\Http\Controllers\IndexController::class,'index'])->middleware(['identify.region'])->name("main");

Route::group([
      'prefix'     => '/{region}',
      'middleware' => 'identify.region',
    ],function(){
        Route::get('/', [App\Http\Controllers\IndexController::class,'index'])->name("index");
        Route::get('/news', function () {return view('news');})->name("news");        
        Route::get('/about', function () {return view('about');})->name("about");        
});    


