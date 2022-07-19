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

    Route::controller(ItemController::class)->group(function () {
        Route::get('/items', 'index')
            ->name('items.index');

        Route::get('items/create', 'create')
            ->name('items.create');

        Route::post('items/store', 'store')
            ->name('items.store');

        Route::get('/items/{item}', 'show')
            ->name('items.show');

        Route::get('items/edit/{item}', 'edit')
            ->name('items.edit');

        Route::post('items/update/{item}', 'update')
            ->name('items.update');

        Route::delete('items/destroy/{item}', 'destroy')
            ->name('items.destroy');
    });

    Route::controller(IssueController::class)->group(function () {
        Route::get('/issues', 'index')
            ->name('issues.index');

        Route::get('issues/create', 'create')
            ->name('issues.create');

        Route::post('issues/store', 'store')
            ->name('issue.store');

        Route::get('/issues/{issue}', 'show')
            ->name('issues.show');

        Route::get('issues/edit/{issue}', 'edit')
            ->name('issues.edit');

        Route::post('issues/update/{issue}', 'update')
            ->name('issues.update');

        Route::delete('issues/destroy/{issue}', 'destroy')
            ->name('issues.destroy');
    });
});


