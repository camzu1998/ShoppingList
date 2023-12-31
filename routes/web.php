<?php

use App\Http\Controllers\ListController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
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
})->name('homepage');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Lists
    Route::resource('lists', ListController::class);
    Route::post('lists/{list}/products', [ListController::class, 'products'])->name('lists.products');
    Route::get('lists/{list}/manage', [ListController::class, 'manage'])->name('lists.manage');
    Route::post('lists/{list}/invite', [ListController::class, 'invite'])->name('lists.invite');
    //Shops
    Route::resource('shops', ShopController::class)->except('show');
    //Products
    Route::resource('products', ProductController::class)->except('show');
});

//Lists
Route::get('lists/{list}/{token:token}/invite', [ListController::class, 'inviteAccept'])->name('lists.invite.accept');

require __DIR__.'/auth.php';
