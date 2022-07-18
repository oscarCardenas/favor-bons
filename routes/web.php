<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ActiveCampaignController;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/categories', [PublicController::class, 'categories'])->name('public.categories');

Route::post('/client', [ActiveCampaignController::class, 'store'])->name('client.store');



Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    
    Route::get('/dashboard', function () { return Inertia::render('Dashboard'); })->name('dashboard');

    Route::post('/user-theme', [HomeController::class, 'themeUpdate'])->name('user-theme.update');

    Route::get('/user-creditcard', [CreditCardController::class, 'show'])->name('user-creditcard.show');
    Route::post('/user-creditcard', [CreditCardController::class, 'update'])->name('user-creditcard.update');
    Route::delete('/user-creditcard', [CreditCardController::class, 'destroy'])->name('user-creditcard.destroy');

});
