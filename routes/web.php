<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListsController;
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
Route::middleware('auth')->group(function () {
    Route::prefix('xhr')->group(function () {
        Route::get('tasks', [TasksXhrController::class, 'index']);
    });

    // Basic routes that require user to be authenticated
    Route::get('lists', [ListsController::class, 'index']);
    Route::post('lists', [ListsController::class, 'create']);
    Route::get('list/{id}', [ListsController::class, 'show']);

    Route::get('tasks', [TasksController::class, 'index']);
    Route::post('task', [TasksController::class, 'create']);
    Route::post('task/{id}/edit', [TasksController::class, 'update']);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

