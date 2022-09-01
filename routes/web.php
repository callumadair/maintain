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
        ->name('items.')->prefix('items')->group(function () {
            Route::get('/', 'index')
                ->name('index');

            Route::get('/create', 'create')
                ->name('create');

            Route::post('/store', 'store')
                ->name('store');

            Route::get('/{item}', 'show')
                ->name('show');

            Route::get('/edit/{item}', 'edit')
                ->name('edit');

            Route::post('/update/{item}', 'update')
                ->name('update');

            Route::delete('/destroy/{item}', 'destroy')
                ->name('destroy');
        });

    Route::controller(IssueController::class)
        ->name('issues.')->prefix('issues')->group(function () {
            Route::get('/', 'index')
                ->name('index');

            //Make the item parameter non-optional
            Route::get('/create/{item?}', 'create')
                ->name('create');

            Route::post('/store', 'store')
                ->name('store');

            Route::get('/{issue}', 'show')
                ->name('show');

            Route::get('/edit/{issue}', 'edit')
                ->name('edit');

            Route::post('/update/{issue}', 'update')
                ->name('update');

            Route::delete('/destroy/{issue}', 'destroy')
                ->name('destroy');
        });

    Route::get('/issues/item_select', [IssueController::class, 'item_select'] )
        ->name('issues.item_select');
});


