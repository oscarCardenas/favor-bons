<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ActiveCampaignController;
use App\Http\Controllers\CustomerSupportController;
use App\Http\Controllers\LoginController;

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
// Route::get('/categories', [PublicController::class, 'categories'])->name('public.categories');
Route::post('/client', [ActiveCampaignController::class, 'store'])->name('client.store');

// Route::get('/login', [LoginController::class, 'create'])->name('login');
// Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    
    Route::get('/dashboard', function () { return Inertia::render('Dashboard'); })->name('dashboard');

    Route::get('/support', [CustomerSupportController::class, 'show'])->name('support.show');
    Route::post('/support', [CustomerSupportController::class, 'store'])->name('support.store');

    Route::post('/user-theme', [HomeController::class, 'themeUpdate'])->name('user-theme.update');

    Route::get('/creditcard-index', [CreditCardController::class, 'index'])->name('creditcard.index');
    Route::post('/creditcard-store', [CreditCardController::class, 'store'])->name('creditcard.store');
    Route::put('/creditcard-update', [CreditCardController::class, 'update'])->name('creditcard.update');
    Route::delete('/creditcard-destroy', [CreditCardController::class, 'destroy'])->name('creditcard.destroy');

    

});
