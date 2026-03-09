<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

// PUBLIC
Route::get('/', function () {
    return view('home');
});

Route::post('submit', [SubmissionController::class, 'store'])
    ->name('submit');

Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comments', [CommentController::class, 'store']);

// ADMIN (login required)
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/submissions', [AdminController::class, 'index'])
        ->name('submissions.index');

    Route::get('/submissions/{submission}', [AdminController::class, 'show'])
        ->name('submissions.show');

    Route::patch('/submissions/{submission}', [AdminController::class, 'update'])
        ->name('submissions.update');

    Route::delete('/submissions/{submission}', [AdminController::class, 'destroy'])
        ->name('submissions.destroy');

});

require __DIR__.'/auth.php';
