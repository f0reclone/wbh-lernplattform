<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ModuleCreateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserManualController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Enums;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/board', [BoardController::class, 'index'])
        ->name('board');

    Route::get('/calendar', [CalendarController::class, 'index'])
        ->name('calendar');

    Route::get('/modules', [ModuleController::class, 'index'])
        ->name('modules');

    Route::get('/modules/create', [ModuleController::class, 'create'])
        ->name('modules.create');

    Route::post('/modules', [ModuleController::class, 'store'])
        ->name('modules.store');

    Route::get('/modules/{module}/edit', [ModuleController::class, 'edit'])
        ->middleware('can:update,module')
        ->name('modules.edit');

    Route::get('/modules/{module}/show', [ModuleController::class, 'show'])
        ->name('modules.show');

    Route::put('/modules/{module}', [ModuleController::class, 'update'])
        ->middleware('can:update,module')
        ->name('modules.update');

    Route::resource('tasks', TaskController::class);

    Route::resource('exams', ExamController::class);

    Route::get('/user-manual', [UserManualController::class, 'index'])
        ->name('user-manual');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
