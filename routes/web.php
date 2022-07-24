<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResourceController;
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

Route::get('/', [ResourceController::class, 'index']);

Route::prefix('/admin')->group(function () {
    Route::get('', [AdminController::class, 'index']);

    Route::prefix('/resource')->group(function() {
        Route::get('pdf', [AdminController::class, 'pdfForm']);

        // Route::post('pdf', [AdminController::class, 'createPdf']);

        Route::post('create', [AdminController::class, 'create']);

        Route::get('pdf/download/{filename}', [AdminController::class, 'downloadFile']);

        Route::get('snippet', [AdminController::class, 'snippetForm']);

        // Route::post('snippet', [AdminController::class, 'createSnippet']);

        Route::get('link', [AdminController::class, 'linkForm']);

        // Route::post('link', [AdminController::class, 'createLink']);

        Route::delete('delete/{id}', [AdminController::class, 'delete'])->name('admin.resources.delete');

        Route::get('edit', [AdminController::class, 'edit'])->name('admin.resources.edit');

        Route::patch('edit/{id}', [AdminController::class, 'editResource']);

    });
});
