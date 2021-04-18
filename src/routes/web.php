<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('https://www.thefirstspine.fr/drifter-s-tales');
});

Route::get('/status', function () {
    return response()->json(['status' => 'ok']);
});

Route::post('/event', [\App\Http\Controllers\EventController::class, 'bounce']);
Route::get('/monarch', [\App\Http\Controllers\MonarchController::class, 'getName']);
