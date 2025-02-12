<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CRM\SalesApprovalController;
use App\Http\Controllers\CRM\SalesConfirmVisitController;
use App\Http\Controllers\CRM\SalesMappingController;
use App\Http\Controllers\CRM\SalesVisitReportController;
use App\Http\Controllers\CRM\ScheduleVisitController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Inventory\ProductController;
use App\Http\Controllers\ManagementSettingController;
use App\Http\Controllers\MasterData\CustomerInvoiceController;
use App\Http\Controllers\MasterData\GeographicController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterData\RegionController;
use App\Http\Controllers\ReceivableEntry\InvoiceController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\PermissionRole;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return view('errors.404');
});

Route::group(['prefix' => 'public-uri'], function () {
    Route::get('/invoice-payment/{receiptNumber}', [InvoiceController::class, 'invoicePaymentView'])->name('public-uri.invoice-payment.view');
    Route::post('/invoice-payment', [InvoiceController::class, 'invoicePaymentPost'])->name('public-uri.invoice-payment');
});

Route::middleware('auth')->group(function () {
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

    Route::group(['prefix' => 'region'], function () {
        Route::get('/area', [RegionController::class, 'getAreas'])->name('region.area.index');
    });

    Route::group(['prefix' => 'api'], function () {
        Route::get('/employees', [EmployeeController::class, 'apiGet'])->name('api.get.employees');
        Route::get('/invoices', [InvoiceController::class, 'apiGet'])->name('api.get.invoices');
        Route::get('/product-invoices', [InvoiceController::class, 'apiGetProductInvoice'])->name('api.get.product-invoices');
        Route::get('/customer-invoices', [CustomerInvoiceController::class, 'apiGet'])->name('api.get.customer-invoices');
        Route::get('/customers', [CustomerController::class, 'apiGet'])->name('api.get.customers');
        Route::post('/product/generate-name-code', [ProductController::class, 'generateNameCode'])->name('api.product.generate.name.code');
        Route::get('/products', [ProductController::class, 'apiGet'])->name('api.get.products');
    });

    Route::middleware(PermissionRole::class)->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::group(['prefix' => 'management-setting'], function () {
            Route::get('/', [ManagementSettingController::class, 'index'])->name('management_setting.index');
            Route::put('/', [ManagementSettingController::class, 'upsert'])->name('management_setting.upsert');
        });

        Route::group(['prefix' => 'receivable'], function () {

            Route::group(['prefix' => 'crm'], function () {
                Route::group(['prefix' => 'sales-mapping'], function () {
                    Route::get('/', [SalesMappingController::class, 'index'])->name('receivable.crm.sales-mapping.index');
                });

                Route::group(['prefix' => 'schedule-visit'], function () {
                    Route::get('/', [ScheduleVisitController::class, 'index'])->name('receivable.crm.schedule-visit.index');
                    Route::get('/create', [ScheduleVisitController::class, 'create'])->name('receivable.crm.schedule-visit.create');
                    Route::post('/create', [ScheduleVisitController::class, 'store'])->name('receivable.crm.schedule-visit.store');
                    Route::put('/cancel/{id}', [ScheduleVisitController::class, 'cancel'])->name('receivable.crm.schedule-visit.cancel');
                });

                Route::group(['prefix' => 'sales-approval'], function () {
                    Route::get('/', [SalesApprovalController::class, 'index'])->name('receivable.crm.sales-approval.index');
                    Route::put('/approvals', [SalesApprovalController::class, 'approval'])->name('receivable.crm.sales-approval.approval');
                });

                Route::group(['prefix' => 'sales-confirm-visit'], function () {
                    Route::get('/', [SalesConfirmVisitController::class, 'index'])->name('receivable.crm.sales-confirm-visit.index');
                    Route::put('/confirm-visit/{schedule_visit}', [SalesConfirmVisitController::class, 'visitConfirmation'])->name('receivable.crm.sales-confirm-visit.confirm');
                });

                Route::group(['prefix' => 'sales-visit-report'], function () {
                    Route::get('/', [SalesVisitReportController::class, 'index'])->name('receivable.crm.sales-visit-report.index');
                });
            });

            Route::group(['prefix' => 'customer'], function () {
                Route::get('/', [CustomerController::class, 'index'])->name('receivable.customer.index');
                Route::get('/trash', [CustomerController::class, 'trash'])->name('receivable.customer.trash');
                Route::delete('/destroy/{customer}', [CustomerController::class, 'destroy'])->name('receivable.customer.destroy');
                Route::put('/restore/{customer}', [CustomerController::class, 'restore'])->name('receivable.customer.restore');
                Route::post('/create', [CustomerController::class, 'store'])->name('receivable.customer.store');
                Route::get('/detail/{customer}', [CustomerController::class, 'show'])->name('receivable.customer.show');
                Route::put('/update/{customer}', [CustomerController::class, 'update'])->name('receivable.customer.update');
            });

            Route::group(['prefix' => 'entry'], function () {
                Route::group(['prefix' => 'invoice'], function () {
                    Route::post('/import', [InvoiceController::class, 'importInvoice'])->name('receivable.entry.invoice.import');
                    Route::delete('/delete/{invoice}', [InvoiceController::class, 'delete'])->name('receivable.entry.invoice.delete');
//                    Route::post('/restore/{id}', [InvoiceController::class, 'restore'])->name('receivable.entry.invoice.restore');
                    Route::get('/', [InvoiceController::class, 'index'])->name('receivable.entry.invoice.index');
//                    Route::get('/trash', [InvoiceController::class, 'trash'])->name('receivable.entry.invoice.trash');
                    Route::post('/export', [InvoiceController::class, 'export'])->name('receivable.entry.invoice.export');
                });
            });
        });

        Route::group(['prefix' => 'inventory'], function () {
            Route::group(['prefix' => '/product'], function () {
                Route::get('/', [ProductController::class, 'index'])->name('inventory.product.index');
                Route::get('/trash', [ProductController::class, 'trash'])->name('inventory.product.trash');
                Route::get('/detail/{product}', [ProductController::class, 'show'])->name('inventory.product.show');
                Route::post('create', [ProductController::class, 'store'])->name('inventory.product.store');
                Route::put('/update/{product}', [ProductController::class, 'update'])->name('inventory.product.update');
                Route::delete('/destroy/{product}', [ProductController::class, 'destroy'])->name('inventory.product.destroy');
                Route::put('/restore/{product}', [ProductController::class, 'restore'])->name('inventory.product.restore');
            });
        });

        Route::group(['prefix' => 'user-management'], function () {
            Route::get('/', [EmployeeController::class, 'index'])->name('user-management.employee.index');
            Route::get('/trash', [EmployeeController::class, 'trash'])->name('user-management.employee.trash');
            Route::post('/create', [EmployeeController::class, 'store'])->name('user-management.employee.store');
            Route::get('/detail/{employee}', [EmployeeController::class, 'show'])->name('user-management.employee.show');
            Route::put('/detail/{employee}', [EmployeeController::class, 'update'])->name('user-management.employee.update');
            Route::delete('/delete/{employee}', [EmployeeController::class, 'destroy'])->name('user-management.employee.destroy');
            Route::put('/restore/{employee}', [EmployeeController::class, 'restore'])->name('user-management.employee.restore');

            Route::group(['prefix' => 'role-management'], function () {
                Route::get('/', [RoleManagementController::class, 'index'])->name('user-management.role-management.index');
                Route::delete('/destroy/{role}', [RoleManagementController::class, 'destroy'])->name('user-management.role-management.destroy');
                Route::post('/create', [RoleManagementController::class, 'store'])->name('user-management.role-management.store');
                Route::get('/create', [RoleManagementController::class, 'create'])->name('user-management.role-management.create');
                Route::put('/edit/{role}', [RoleManagementController::class, 'update'])->name('user-management.role-management.update');
                Route::get('/detail/{role}', [RoleManagementController::class, 'show'])->name('user-management.role-management.show');
            });

        });

    });
});

require __DIR__ . '/auth.php';
