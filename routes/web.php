<?php

use App\Http\Controllers\ToDoController\TodoController;
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
    return redirect()->route('showToDoPlan');
});

Route::get('plan/create', [TodoController::class, 'createToDoPlan'])->name('createToDoPlan');

Route::get('plan/show', [TodoController::class, 'showToDoPlan'])->name('showToDoPlan');

/* Save tasks from provider with web ui */
Route::get('tasks/save', [TodoController::class, 'saveTasksToDB'])->name('saveTasksToDB');
