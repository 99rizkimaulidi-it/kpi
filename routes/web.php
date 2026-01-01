<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth']);

Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:co-admin,super-admin'])->group(function () {
    Route::resource('tasks', TaskController::class)->except(['show', 'destroy']);
    Route::post('tasks/{task}/submissions', [SubmissionController::class, 'store'])->name('tasks.submissions.store')->withoutMiddleware('role:co-admin,super-admin');
    Route::post('submissions/{submission}/ratings', [EvaluationController::class, 'store'])->name('submissions.ratings.store');
    Route::get('kpi/recap', [KpiController::class, 'recap'])->name('kpi.recap');
});

Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['show', 'destroy']);
    Route::get('reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.excel');
    Route::get('reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.pdf');
});

Route::middleware('auth')->group(function () {
    Route::get('chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('chat/{chat}', [ChatController::class, 'storeMessage'])->name('chat.store');
});

