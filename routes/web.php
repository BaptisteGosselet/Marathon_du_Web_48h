<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\ListeController;
use Illuminate\Support\Facades\Route;

//use
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

Route::get('/', function() {
    return view('welcome');
});

Route::get('/', [WelcomeController::class, 'show'])->name('welcome');

Route::get('/series', [ListeController::class, 'show'])->name('listeSeries');
Route::get('/series/search', [ListeController::class, 'search'])->name('searchSerie');
Route::get('/series/filtre', [ListeController::class, 'showFiltre'])->name('showFiltreSerie');

Route::get('/series/{id}', [SeriesController::class, 'show'])->name('showSerie');

Route::get('/user/{id}',[UserController::class, 'show'])->name('showUser');

Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

Route::post('/series/{id}/addComment', [SeriesController::class, 'addComment'])->name('addComment');

Route::get('/series/{idSerie}/{idComment}/validerComment', [SeriesController::class, 'validerComment'])->name('validerComment');

Route::get('/series/{id}/addSerieView', [SeriesController::class, 'addSerieView'])->name('addSerieView');
Route::get('/series/{id}/removeSerieView', [SeriesController::class, 'removeSerieView'])->name('removeSerieView');

Route::get('/series/{id}/deleteComment/{idComment}', [SeriesController::class, 'deleteComment'])->name('deleteComment');

Route::get('/series/{id}/addAvis', [SeriesController::class, 'addAvis'])->name('addAvis');

Route::get('/series/{id}/addUrl', [SeriesController::class, 'addUrl'])->name('addUrl');
//Route::post("/login", );
