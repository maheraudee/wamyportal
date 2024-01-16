<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BasicdataController;
use App\Http\Controllers\BoxbalanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Inventory\{HardwareController,StoreController,ManufacturerController, InventoryController,InvtytrackController};
use App\Http\Controllers\Saving\BoxorderController;
use App\Http\Controllers\Saving\BoxordersanalyseController;
use App\Http\Controllers\Saving\SavingController;
use App\Http\Controllers\Saving\WithdrawController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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
Route::get('/mma', function () {
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('optimize');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return 'Optimization Done';
});

/* Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
}); */

Route::middleware(['auth'])->group(function () {
    Route::resource('stores',StoreController::class);
    Route::resource('hardwares',HardwareController::class);
    Route::resource('manufacturers',ManufacturerController::class);
    Route::resource('inventories',InventoryController::class);
    Route::resource('invtytracks',InvtytrackController::class);
    Route::resource('employees',EmployeeController::class);
    Route::resource('savings',SavingController::class);
    Route::resource('orders',BoxorderController::class);
    Route::resource('withdraws',WithdrawController::class);
    Route::resource('boanalyses',BoxordersanalyseController::class);
    Route::resource('boxbalances',BoxbalanceController::class);

    Route::controller(SavingController::class)->group(function(){
        Route::get('savings/contracts/{m}', 'getcontractAll')->name('getcontractAll');
        Route::get('savings/showAll/{m}', 'showAll')->name('showAll');
        Route::get('savings/alltrans/{m}', 'alltrans')->name('alltrans');
        Route::get('savings/contributors/{m}', 'getcontributors')->name('getcontributors');
        Route::get('savings/download/{filename}', 'getDownload')->name('getDownload');
        Route::get('savings/view_file/{filename}', 'open_file')->name('getfile');
    });

    Route::controller(BoxorderController::class)->group(function(){
        Route::post('getorder', 'getorder')->name('getorder');
        Route::post('destroyorder', 'destroyorder')->name('destroyorder');
    });

    Route::controller(BoxordersanalyseController::class)->group(function(){
        Route::get('printcontractOrder/{id}', 'printcontractOrder')->name('printcontractOrder');
        Route::get('contractOrder/{id}/{typ}/{m}', 'contractOrder')->name('contractOrder');
        Route::post('updatecontractOrder/{typ}', 'updatecontractOrder')->name('updatecontractOrder');
    });

    Route::middleware(['role:SuperAdmin'])->name('admin.')->prefix('admin')->group(function () {
        Route::resource('roles',RoleController::class);
        Route::post('roles/{role}/permissions',[RoleController::class,'givePermission'])->name('roles.permissions');
        Route::delete('roles/{role}/permissions/{permission}',[RoleController::class,'revokePermission'])->name('roles.permissions.revoke');
        Route::resource('permissions',PermissionController::class);
        Route::post('permissions/{permission}/roles',[PermissionController::class,'assignRole'])->name('permissions.roles');
        Route::delete('permissions/{permission}/roles/{role}',[PermissionController::class,'removeRole'])->name('permissions.roles.remove');
        Route::get('users',[UserController::class,'index'])->name('users.index');
        Route::delete('users/{user}',[UserController::class,'destroy'])->name('users.destroy');

        Route::get('users/{user}',[UserController::class,'show'])->name('users.show');

        Route::post('users/{user}/roles',[UserController::class,'assignRole'])->name('users.roles');
        Route::delete('users/{user}/roles/{role}',[UserController::class,'removeRole'])->name('users.roles.remove');

        Route::post('users/{user}/permissions',[UserController::class,'givePermission'])->name('users.permissions');
        Route::delete('users/{user}/permissions/{permission}',[UserController::class,'revokePermission'])->name('users.permissions.revoke');
    });

    Route::post('printcustody/{id}',[InventoryController::class,'getCustody'])->name('getCustody');

    Route::controller(BasicdataController::class)->group(function(){
        Route::patch('updateStatues/{type}','updateStatues')->name('updateStatues');
        Route::get('transferfromoldData','transferfromoldData')->name('transferfromoldData');
        Route::get('getPeriodajax','getPeriodajax')->name('getPeriodajax');
    });

    Route::controller(EmployeeController::class)->group(function(){
        Route::get('storemployees','storeEmp')->name('storeEmp');
        Route::get('storeboxhr','storeBox')->name('storeBox');
        Route::get('storeboxtemp','storeboxtemp')->name('storeboxtemp');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
