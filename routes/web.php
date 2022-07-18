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

    Route::get('/items', function () {
        return Inertia::render('Items/index');
    })->name('items/index');

    Route::get('/items/{item}', [ItemController::class, 'show'])
        ->name('items/show');

    Route::get('/issues', function () {
        return Inertia::render('Issues/index');
    })->name('issues/index');

    Route::get('/issues/{issue}', [IssueController::class, 'show'])
        ->name('issues/show');
});


