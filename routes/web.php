<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers;

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

Route::get('/', fn () => Inertia::render('Welcome'))->name('welcome');

Route::middleware([
    config('jetstream.auth_session'),
])->group(function () {
    Route::prefix('memo')->controller(Controllers\MemoController::class)->group(function () {
        Route::get('/', 'index')->name('memo.index');
        Route::post('create', 'create')->name('memo.create');
        Route::get('edit/{id}', 'edit')->name('memo.edit');
        Route::post('update/{id}', 'update')->name('memo.update');
        Route::post('destroy/{id}', 'destroy')->name('memo.destroy');
    });
});
