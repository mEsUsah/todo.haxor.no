<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListsController;
use App\Http\Controllers\TasksController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/lists', [ListsController::class, 'index'])->middleware('auth');
Route::post('/lists', [ListsController::class, 'create'])->middleware('auth');
Route::get('/list/{id}', [ListsController::class, 'show'])->middleware('auth');

Route::get('/tasks', [TasksController::class, 'index'])->middleware('auth');
Route::post('/task', [TasksController::class, 'create'])->middleware('auth');
Route::post('/task/{id}/edit', [TasksController::class, 'update'])->middleware('auth');

