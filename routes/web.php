<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserLanguageController;

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
    return redirect('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {

        Route::resource('users', UserController::class);
        Route::get('all-regions', [RegionsController::class, 'index'])->name(
            'all-regions.index'
        );
        Route::post('all-regions', [RegionsController::class, 'store'])->name(
            'all-regions.store'
        );
        Route::get('all-regions/create', [
            RegionsController::class,
            'create',
        ])->name('all-regions.create');
        Route::get('all-regions/{regions}', [
            RegionsController::class,
            'show',
        ])->name('all-regions.show');
        Route::get('all-regions/{regions}/edit', [
            RegionsController::class,
            'edit',
        ])->name('all-regions.edit');
        Route::put('all-regions/{regions}', [
            RegionsController::class,
            'update',
        ])->name('all-regions.update');
        Route::delete('all-regions/{regions}', [
            RegionsController::class,
            'destroy',
        ])->name('all-regions.destroy');

        Route::resource('districts', DistrictController::class);
    });
