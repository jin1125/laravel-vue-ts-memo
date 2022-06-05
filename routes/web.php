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
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('memo')->group(function () {
        Route::get('/', [Controllers\MemoController::class, 'index'])->name('memo.index');
        Route::post('create', [Controllers\MemoController::class, 'create'])->name('memo.create');
        Route::get('edit/{id}', [Controllers\MemoController::class, 'edit'])->name('memo.edit');
        Route::post('update/{id}', [Controllers\MemoController::class, 'update'])->name('memo.update');
        Route::post('destroy/{id}', [Controllers\MemoController::class, 'destroy'])->name('memo.destroy');
    });
});
