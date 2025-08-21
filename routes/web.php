<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DataUmumController;
use App\Http\Controllers\Admin\DataUmumDocumentCategoryController;
use App\Http\Controllers\Admin\DocumentCategoryController;
use App\Http\Controllers\Admin\DuDcDetailController;


// Halaman utama

Route::get('/', [DataUmumController::class, 'index'])->name('admin.data-umum.index');


// Data Umum + Relasi DocumentCategory

Route::prefix('data-umum')->group(function () {
    Route::get('/{id}', [DataUmumDocumentCategoryController::class, 'show'])->name('admin.data-umum.show');
    Route::post('/{id}/document-category/store', [DataUmumDocumentCategoryController::class, 'store'])->name('admin.data-umum.document-category.store');
    Route::put('/document-category/{id}/update', [DataUmumDocumentCategoryController::class, 'update'])->name('admin.data-umum.document-category.update');
    Route::delete('/document-category/{id}/destroy', [DataUmumDocumentCategoryController::class, 'destroy'])->name('admin.data-umum.document-category.destroy');
});


// DuDcDetail
Route::prefix('du-dc')->group(function () {
    Route::get('/{id}', [DataUmumDocumentCategoryController::class, 'detailFiles'])->name('admin.du-dc.index');
    Route::post('/{id}/store', [DuDcDetailController::class, 'store'])->name('admin.du-dc-detail.store');
    Route::delete('/{id}/destroy', [DuDcDetailController::class, 'destroy'])->name('admin.du-dc-detail.destroy');
});


// Document Category
Route::prefix('category')->group(function () {
    Route::get('/', [DocumentCategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/create', [DocumentCategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/store', [DocumentCategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/edit/{id}', [DocumentCategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/update/{id}', [DocumentCategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/destroy/{id}', [DocumentCategoryController::class, 'destroy'])->name('admin.category.destroy');
});
