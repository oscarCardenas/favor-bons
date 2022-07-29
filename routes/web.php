<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\BillingAddresController;
use App\Http\Controllers\ActiveCampaignController;
use App\Http\Controllers\CustomerSupportController;
use App\Http\Controllers\Auth\RegisteredUserController;

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
Route::post('/client', [ActiveCampaignController::class, 'store'])->name('client.store');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register.create');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
Route::get('/support', [CustomerSupportController::class, 'show'])->name('support.show');
Route::post('/support', [CustomerSupportController::class, 'store'])->name('support.store');
Route::get('/terms', function () { return Inertia::render('TermsOfService'); })->name('terms.show');
Route::get('/policy', function () { return Inertia::render('PrivacyPolicy'); })->name('policy.show');

Route::get('/categories', [CategoryController::class, 'public'])->name('categories.public');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    
    Route::get('/dashboard', function () { return Inertia::render('Dashboard'); })->name('dashboard');
    Route::post('/user-theme', [HomeController::class, 'themeUpdate'])->name('user-theme.update');

    Route::get('/creditcard-index', [CreditCardController::class, 'index'])->name('creditcard.index');
    Route::post('/creditcard-store', [CreditCardController::class, 'store'])->name('creditcard.store');
    Route::put('/creditcard-update', [CreditCardController::class, 'update'])->name('creditcard.update');
    Route::put('/creditcard-activate', [CreditCardController::class, 'activate'])->name('creditcard.activate');
    Route::delete('/creditcard-destroy', [CreditCardController::class, 'destroy'])->name('creditcard.destroy');

    Route::get('/billing-index', [BillingAddresController::class, 'index'])->name('billing.index');
    Route::post('/billing-store', [BillingAddresController::class, 'store'])->name('billing.store');
    Route::put('/billing-update', [BillingAddresController::class, 'update'])->name('billing.update');
    Route::put('/billing-activate', [BillingAddresController::class, 'activate'])->name('billing.activate');
    Route::delete('/billing-destroy', [BillingAddresController::class, 'destroy'])->name('billing.destroy');

});
