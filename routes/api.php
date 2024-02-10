<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Dashboard\DashboardController;
use App\Http\Controllers\Api\Booking\MemberController;
use App\Http\Controllers\Api\Service\ServiceController;
use App\Http\Controllers\Api\Page\PageController;
use App\Http\Controllers\Api\Article\ArticleController;

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

    // Booking
    Route::name('booking.')->prefix('booking')->group(function () {
        // Member
        Route::post('member', [MemberController::class, 'store']);
    });
});
