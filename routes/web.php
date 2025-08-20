<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('data_umum.index');
// });
Route::get('/', [App\Http\Controllers\Admin\DataUmumController::class, 'index'])->name('admin.data-umum.index');

Route::prefix('category')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DocumentCategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/create', [App\Http\Controllers\Admin\DocumentCategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/store', [App\Http\Controllers\Admin\DocumentCategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/edit/{id}', [App\Http\Controllers\Admin\DocumentCategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/update/{id}', [App\Http\Controllers\Admin\DocumentCategoryController::class, 'update'])->name('admin.category.update');
});
