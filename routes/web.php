<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TaskListXhrController;
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
        Route::get('lists', [TaskListXhrController::class, 'index']);
        Route::get('list/{id}', [TaskListXhrController::class, 'show']);
        
        Route::get('tasks', [TasksXhrController::class, 'index']);
        Route::post('task', [TasksXhrController::class, 'create']);
        Route::post('task/{id}/edit', [TasksXhrController::class, 'update']);
        Route::post('task/{id}/delete', [TasksXhrController::class, 'delete']);
    });

    // VUE.js app
    Route::get('list/{id}', [TaskListController::class, 'show']);

    // Regular blade
    Route::get('lists', [TaskListController::class, 'index'])->name('lists');
    Route::post('list', [TaskListController::class, 'create']);

    // User management
    Route::get('users', [UsersController::class, 'index'])->name('users');
    Route::post('user', [UsersController::class, 'create']);
});