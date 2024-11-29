<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
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

        Route::group(['prefix' => 'receivable'], function () {
            Route::group(['prefix' => 'customer'], function () {
                Route::get('/', [CustomerController::class, 'index'])->name('receivable.customer.index');
                Route::get('/trash', [CustomerController::class, 'trash'])->name('receivable.customer.trash');
                Route::delete('/destroy/{customer}', [CustomerController::class, 'destroy'])->name('receivable.customer.destroy');
                Route::put('/restore/{customer}', [CustomerController::class, 'restore'])->name('receivable.customer.restore');

                Route::post('/create', [CustomerController::class, 'index'])->name('receivable.customer.store');
                Route::get('/detail/{customer}', [CustomerController::class, 'index'])->name('receivable.customer.detail');
                Route::put('/update/{customer}', [CustomerController::class, 'update'])->name('receivable.customer.update');
            });
        });

        Route::group(['prefix' => 'user-management'], function () {
            Route::get('/', [EmployeeController::class, 'index'])->name('user-management.employee.index');
            Route::get('/trash', [EmployeeController::class, 'trash'])->name('user-management.employee.trash');
            Route::get('/sales', [EmployeeController::class, 'indexSales'])->name('user-management.employee.sales.index');
            Route::get('/sales/trash', [EmployeeController::class, 'trashSales'])->name('user-management.employee.sales.trash');
            Route::post('/create', [EmployeeController::class, 'store'])->name('user-management.employee.store');
            Route::get('/detail/{employee}', [EmployeeController::class, 'show'])->name('user-management.employee.show');
            Route::put('/detail/{employee}', [EmployeeController::class, 'update'])->name('user-management.employee.update');
            Route::delete('/delete/{employee}', [EmployeeController::class, 'destroy'])->name('user-management.employee.destroy');
            Route::put('/restore/{employee}', [EmployeeController::class, 'restore'])->name('user-management.employee.restore');
        });

    });
});

require __DIR__ . '/auth.php';
