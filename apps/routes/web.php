<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\GeoController;

Route::get('/', function() {
    return Redirect::to(route('dashboard'));
})->name('dashboard');

Route::controller(AuthController::class)->group(function () {
    Route::get('auth', 'index')->name('auth-index');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
});

Route::controller(CustomerController::class)->group(function () {
    Route::group([
        'prefix' => 'customer',
    ], function() {
        Route::get('list', 'list')->name('customer_list');
    });
});

Route::controller(DeviceController::class)->group(function () {
    Route::group([
        'prefix' => 'device',
    ], function() {
        Route::get('js','list_js')->name('device_list_js');
        Route::post('js/add','create_update')->name('device_create_update');

        Route::get('list','list')->name('device_list');
        Route::get('detail/{deviceid}', 'detail')->name('device_detail');
        Route::get('add', 'createIndex')->name('device_create_index');
    });
});

Route::controller(GeoController::class)->group(function () {
    Route::group([
        'prefix' => 'geo',
    ], function() {
        Route::get('add', 'formindex')->name('geo_create_index');
    });
});
