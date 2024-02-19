<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Dashboard\DashboardController;
use App\Http\Controllers\Api\Booking\{DailyController, MemberController, HistoryController};
use App\Http\Controllers\Api\Service\ServiceController;
use App\Http\Controllers\Api\Page\PageController;
use App\Http\Controllers\Api\Article\ArticleController;
use App\Http\Controllers\Api\Price\{PriceDailyController, PriceMemberController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index']);

    // Services
    Route::get('services', [ServiceController::class, 'index']);

    // Pages
    Route::get('pages/{slug}', [PageController::class, 'index']);

    // Article
    Route::get('articles/{slug}', [ArticleController::class, 'index']);

    // Price
    Route::name('price.')->prefix('price')->group(function () {
        // Dailies
        Route::get('dailies', [PriceDailyController::class, 'index']);
        // Members
        Route::get('members', [PriceMemberController::class, 'index']);
    });

    // Booking
    Route::name('booking.')->prefix('booking')->group(function () {
        // Daily
        Route::post('daily', [DailyController::class, 'store']);
        // Member
        Route::post('member', [MemberController::class, 'store']);

        // History
        Route::name('histories.')->prefix('histories')->group(function () {
            // Daily
            Route::get('dailies', [HistoryController::class, 'daily']);
            // Member
            Route::get('members', [HistoryController::class, 'member']);
            // Member
            Route::get('schools', [HistoryController::class, 'school']);
        });
    });
});
