<?php

use App\Http\Controllers\TasksController;
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
    return redirect(auth()->guest() ? '/login' : '/tasks');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/tasks', [TasksController::class, 'show'])->name('dashboard');
});

require __DIR__ . '/auth.php';
