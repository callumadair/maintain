<?php

use App\Http\Controllers\IssueController;
use App\Http\Controllers\ItemController;
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
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::redirect('/', '/dashboard');

    Route::controller(ItemController::class)
        ->prefix('items')->group(function () {
            Route::get('/', 'index')
                ->name('items.index');

            Route::get('/create', 'create')
                ->name('items.create');

            Route::post('/store', 'store')
                ->name('items.store');

            Route::get('/{item}', 'show')
                ->name('items.show');

            Route::get('/edit/{item}', 'edit')
                ->name('items.edit');

            Route::post('/update/{item}', 'update')
                ->name('items.update');

            Route::delete('/destroy/{item}', 'destroy')
                ->name('items.destroy');
        });

    Route::controller(IssueController::class)
        ->prefix('issues')->group(function () {
            Route::get('/', 'index')
                ->name('issues.index');

            Route::get('/create/{item?}', 'create')
                ->name('issues.create');

            Route::post('/store', 'store')
                ->name('issues.store');

            Route::get('/{issue}', 'show')
                ->name('issues.show');

            Route::get('/edit/{issue}', 'edit')
                ->name('issues.edit');

            Route::post('/update/{issue}', 'update')
                ->name('issues.update');

            Route::delete('/destroy/{issue}', 'destroy')
                ->name('issues.destroy');
        });
});


