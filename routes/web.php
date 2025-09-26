<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BillCategoryController,
    BillController,
    DashboardController,
    FlatController,
};
use App\Http\Controllers\Admin\{
    HouseOwnerController as AdminHouseOwnerController,
    TenantController as AdminTenantController
};
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

require __DIR__ . '/auth.php';


Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('bill-category', BillCategoryController::class);
    Route::resource('bills', BillController::class);
    Route::post('bills/{bill}/pay', [BillController::class, 'pay'])->name('bills.pay');

    Route::middleware(['role:house_owner'])->group(function () {
        Route::resource('flats', FlatController::class);
    });


    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {


        Route::resource('house-owners', AdminHouseOwnerController::class);


        Route::resource('tenants', AdminTenantController::class);

        Route::get('tenants/flats/{house_owner_id}', [AdminTenantController::class, 'getFlats'])
            ->name('tenants.get-flats');
    });
});


Route::fallback(function () {
    return view('errors.404');
});
