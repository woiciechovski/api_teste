<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\VerifyEmailController;
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

Route::middleware('auth:api')->prefix('v1')->group(function () {

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/teste', [UserController::class, 'store'])->name('teste');
        Route::get('/{user}', [UserController::class, 'show'])->name('user.show');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::put('/{user}', [UserController::class, 'update'])->name('user.update');

        Route::delete('/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    });
});
Route::prefix('v1')->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
});
