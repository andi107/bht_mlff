<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Admin\TrackingController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\GeoController;
use App\Http\Controllers\Admin\GeoMlffController;
use App\Http\Controllers\Admin\TollRouteController;
use App\Http\Controllers\Admin\DevToolsController;
use App\Http\Controllers\Info\DataController;

Route::get('/', function() {
    return Redirect::to(route('dashboard'));
})->name('dashboard');

Route::controller(AuthController::class)->group(function () {
    Route::get('auth', 'index')->name('auth-index');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('dashboard/js', 'divice_map')->name('dashboard_js');
    Route::get('dashboard', 'index')->name('dashboard');
    
    Route::get('test', 'test')->name('test');
    Route::get('test/js', 'test_gate_import')->name('test_gate_import');
    Route::get('test/section/js', 'import_section')->name('import_section');
    Route::get('test/sectionlatlng/js', 'import_section_latlng')->name('import_section_latlng');
});

Route::controller(TrackingController::class)->group(function () {
    Route::group([
        'prefix' => 'tracking',
    ], function() {
        Route::get('list/js', 'device_list_js')->name('tracking_list_js');
        Route::get('detail/js/map', 'detail_js_map')->name('tracking_map_js');
        Route::get('detail/js/geo/{device_id}', 'detail_js_geo')->name('tracking_map_js');
        
        Route::get('list', 'list')->name('tracking_list');
        Route::get('detail/{deviceid}/status', 'detail_status')->name('tracking_status');
        Route::get('detail/{deviceid}/map', 'detail_map')->name('tracking_map');
        Route::get('detail/{deviceid}/geofence', 'detail_geo')->name('tracking_geo');
        Route::get('detail/{deviceid}/live', 'detail_live')->name('tracking_live');
        Route::get('detail/{deviceid}/mlff', 'detail_mlff')->name('tracking_mlff');
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
        Route::get('js','list_js')->name('geo_list_js');
        Route::post('js/add','create_update')->name('geo_create_update_js');
        Route::get('js/detail/{geoid}/point','detail_point')->name('geo_detail_point_js');
        
        Route::get('list','list')->name('geo_list');
        Route::get('add', 'formindex')->name('geo_create_index');
        Route::get('detail/{geoid}', 'detail')->name('geo_detail');
    });
});

Route::controller(GeoMlffController::class)->group(function () {
    Route::group([
        'prefix' => 'geomlff',
    ], function() {
        Route::get('js','list_js')->name('geomlff_list_js');
        Route::post('js/add','create_update')->name('geomlff_create_update_js');
        Route::get('js/detail/{geoid}/point','detail_point')->name('geomlff_detail_point_js');
        Route::get('gatepoint/js','tollmapindex_js')->name('tollmapindex_js');
        Route::get('gatepoint/section/js','tollmapsection_js')->name('tollmapsection_js');
        Route::get('gatepoint/section/js/{section_name}','tollmapsection_map_js')->name('tollmapsection_map_js');
        Route::get('gatepoint/section/det/js/{id}','tollmapsection_map_det_js')->name('tollmapsection_map_js');

        Route::get('list','list')->name('geomlff_list');
        Route::get('add', 'formindex')->name('geomlff_create_index');
        Route::get('detail/{geoid}', 'detail')->name('geomlff_detail');
        Route::get('gatepoint', 'tollmapindex')->name('tollmapindex');
    });
});

Route::controller(TollRouteController::class)->group(function () {
    Route::group([
        'prefix' => 'tollroute',
    ], function() {
        Route::get('js','list_js')->name('tollroute_list_js');
        Route::post('js/add','create_update')->name('tollroute_create_update_js');
        Route::get('js/detail/{geoid}/point','detail_point')->name('tollroute_detail_point_js');
        
        Route::get('list','list')->name('tollroute_list');
        Route::get('add', 'formindex')->name('tollroute_create_index');
        Route::get('detail/{geoid}', 'detail')->name('tollroute_detail');
    });
});

Route::controller(DevToolsController::class)->group(function () {
    Route::group([
        'prefix' => 'devtools',
    ], function() {
        Route::get('monitor/js/devices','divice_live_js')->name('devices_live_js');
        
        Route::get('/','index')->name('dev_src_monitor');
        Route::get('monitor/devices','devices_live')->name('devices_live');
    });
});
Route::controller(DataController::class)->group(function () {
    Route::group([
        'prefix' => 'info',
    ], function() {
        Route::get('js/geo/{geoid}','geo_info_js')->name('geo_info_js');
        Route::get('js/device/{deviceid}','device_info_js')->name('device_info_js');
        Route::get('js/geonotif/{deviceid}/{geoid}','device_geonotif_js')->name('device_geonotif_js');
        // /info/js/geonotif/${res.id}/${res.geoid}
    });
});