<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ListsXhrController;
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
Auth::routes(['register' => false]);

Route::get('/', function() {
    return redirect()->route('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function() {
    Route::prefix('xhr')->group(function () {
        Route::get('lists', [ListsXhrController::class, 'index']);
        Route::get('list/{id}', [ListsXhrController::class, 'show']);
        
        Route::get('tasks', [TasksXhrController::class, 'index']);
        Route::post('task', [TasksXhrController::class, 'create']);
        Route::post('task/{id}/edit', [TasksXhrController::class, 'update']);
        Route::post('task/{id}/delete', [TasksXhrController::class, 'delete']);
    });

    // VUE.js app
    Route::get('list/{id}', [ListsController::class, 'show']);

    // Regular blade
    Route::get('lists', [ListsController::class, 'index'])->name('lists');
    Route::post('lists', [ListsController::class, 'create']);

    // User management
    Route::get('users', [UsersController::class, 'index']);
    Route::post('user', [UsersController::class, 'create']);
});