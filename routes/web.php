<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListsController;
use App\Http\Controllers\ListsOgController;
use App\Http\Controllers\ListsXhrController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TasksXhrController;

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
Route::middleware('auth')->group(function() {
    Route::prefix('xhr')->group(function () {
        Route::get('lists', [ListsXhrController::class, 'index']);
        Route::get('list/{id}', [ListsXhrController::class, 'show']);
        
        Route::get('tasks', [TasksXhrController::class, 'index']);
    });

    // Basic "OG" routes that require user to be authenticated
    Route::prefix('og')->group(function () {
        Route::get('lists', [ListsOgController::class, 'index']);
        Route::post('lists', [ListsOgController::class, 'create']);
        Route::get('list/{id}', [ListsOgController::class, 'show']);
    
        Route::get('tasks', [TasksController::class, 'index']);
        Route::post('task', [TasksController::class, 'create']);
        Route::post('task/{id}/edit', [TasksController::class, 'update']);
    });

    // VUE.js app
    Route::get('list/{id}', [ListsController::class, 'show']);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

