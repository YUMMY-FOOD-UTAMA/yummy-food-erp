<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\MasterData\GeographicController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\PermissionRole;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return view('errors.404');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'account'], function () {
        Route::get('/', [AccountController::class, 'index'])->name('account.index');
        Route::get('/setting', [AccountController::class, 'setting'])->name('account.setting');
        Route::put('/{user}', [AccountController::class, 'update'])->name('account.update');
        Route::put('/{user}/change-mail', [AccountController::class, 'changeMail'])
            ->name('account.change-mail')->middleware(['throttle:6,1', 'feature:change-mail,on,404']);
        Route::put('/{user}/change-password', [AccountController::class, 'changePassword'])
            ->name('account.change-password')->middleware(['throttle:6,60']);
    });

    Route::group(['prefix' => 'geographic'], function () {
        Route::get('/province', [GeographicController::class, 'getProvince'])->name('geographic.province');
        Route::get('/district', [GeographicController::class, 'getDistrict'])->name('geographic.district');
        Route::get('/sub-district', [GeographicController::class, 'getSubDistrict'])->name('geographic.sub-district');
        Route::get('/sub-district-village', [GeographicController::class, 'getVillage'])->name('geographic.sub-village-district');
    });

    Route::middleware(PermissionRole::class)->group(function () {

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::get('/trash', [UserController::class, 'trash'])->name('user.trash');
            Route::get('/detail/{user}', [UserController::class, 'show'])->name('user.show');
            Route::put('/detail/{user}', [UserController::class, 'edit'])->name('user.edit');
            Route::post('/create', [UserController::class, 'store'])->name('user.store');
            Route::put('/restore/{user}', [UserController::class, 'restore'])->name('user.restore');
            Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');
            Route::delete('/force-delete/{user}', [UserController::class, 'forceDelete'])->name('user.force-delete');
        });

    });
});

require __DIR__ . '/auth.php';
