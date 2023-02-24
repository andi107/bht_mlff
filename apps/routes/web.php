<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Admin\TrackingController;
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

Route::controller(TrackingController::class)->group(function () {
    Route::group([
        'prefix' => 'tracking',
    ], function() {
        Route::get('list/js', 'device_list_js')->name('tracking_list_js');
        Route::get('detail/js/map', 'detail_js_map')->name('tracking_map_js');
        Route::get('list', 'list')->name('tracking_list');
        Route::get('detail/{deviceid}/status', 'detail_status')->name('tracking_status');
        Route::get('detail/{deviceid}/map', 'detail_map')->name('tracking_map');
        Route::get('detail/{deviceid}/geofence', 'detail_geo')->name('tracking_geo');
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
        Route::post('js/add','create_update')->name('geo_create_update_js');

        Route::get('add', 'formindex')->name('geo_create_index');
    });
});
