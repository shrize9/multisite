<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegionController;
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

Route::prefix("region")->group(function(){
    Route::post('/', [RegionController::class, 'create']);
    Route::get('/load/', [RegionController::class, 'load']);
    Route::get('/list/', [RegionController::class, 'list']);
    Route::delete('/{regionId}', [RegionController::class, 'remove']);
}); 

