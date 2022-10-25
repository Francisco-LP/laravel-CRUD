<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;

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
/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/series', function () {
    return view('series.index');
});
*/
//Route::get('/series/crear', [SeriesController::class,'create']);

//Route::get('/series/edit', [SeriesController::class,'edit']);

//Route::get('/series/create',[SeriesController::class,'create']);

//todas las rutas
Route::resource('series', SeriesController::class)->middleware('auth');

//en la utentificacion que no muestre el olvidaste contraseña 
Auth::routes(['reset'=>false,'remember'=>false]);

Route::get('/home', [SeriesController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [SeriesController::class, 'index'])->name('home');
});


