<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/boards', function () {
    return Inertia::render('Boards');
})->middleware(['auth', 'verified'])->name('boards');
Route::get('/calendar', function () {
    return Inertia::render('Calendar');
})->middleware(['auth', 'verified'])->name('calendar');
Route::get('/modules', function () {
    return Inertia::render('Modules');
})->middleware(['auth', 'verified'])->name('modules');
Route::get('/help', function () {
    return Inertia::render('Help');
})->middleware(['auth', 'verified'])->name('help');
Route::get('/modules/tasks', function () {
    return Inertia::render('Tasks');
})->middleware(['auth', 'verified'])->name('tasks');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
