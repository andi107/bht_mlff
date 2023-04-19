<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([
    'prefix' => 'api',
    'middleware' => ['nocache','hideserver', 'security','csp','gzip'],
], function() use($router) {
    $router->get('check', 'Users\CheckController@index');
    $router->group([
        'prefix' => 'auth',
        'middleware' => ['middleware' => 'throttle:5,1']
    ], function() use($router) {
        $router->post('/', 'Users\AuthController@index');
        $router->post('logout', 'Users\CheckController@go_logout');
    });
    
    $router->group([
        'prefix' => 'user',
        'middleware' => ['root']
    ], function() use($router) {
        $router->get('/', 'Admin\UsersController@index');
        $router->post('/', 'Admin\UsersController@create');
        $router->put('/', 'Admin\UsersController@update');
        $router->get('d/{uid}', 'Admin\UsersController@detail');
    });
    $router->group([
        'prefix' => 'dashboard'
    ], function() use($router) {
        $router->get('/', 'Admin\DashboardController@index');
        $router->get('test', 'Admin\DashboardController@test');
        $router->get('test/section', 'Admin\DashboardController@importSection');
        $router->get('test/sectionlatlng', 'Admin\DashboardController@importSectionLatLng');
    });
    $router->group([
        'prefix' => 'device'
    ], function() use($router) {
        $router->get('/', 'Admin\DeviceController@list');
        $router->post('/', 'Admin\DeviceController@create');
        $router->put('/', 'Admin\DeviceController@update');
        $router->get('d/{deviceid}', 'Admin\DeviceController@detail');
    });

    $router->group([
        'prefix' => 'tracking'
    ], function() use($router) {
        $router->get('/', 'Admin\TrackingController@list');
        $router->get('d/{device_id}', 'Admin\TrackingController@detail');
        $router->get('d/{device_id}/geo', 'Admin\TrackingController@tracking_geo');
        $router->get('d/map/relay', 'Admin\TrackingController@tracking_map');
        $router->get('d/mlff/log/{device_id}', 'Admin\TrackingController@tracking_mlff_declare_log');
    });

    $router->group([
        'prefix' => 'geo'
    ], function() use($router) {
        $router->get('/', 'Admin\GeoController@list');
        $router->post('/', 'Admin\GeoController@create');
        $router->put('/', 'Admin\GeoController@update');
        $router->get('d/{geoid}', 'Admin\GeoController@detail');
        $router->get('d/{geoid}/point', 'Admin\GeoController@detail_point');
    });

    $router->group([
        'prefix' => 'geomlff',
        'middleware' => ['root']
    ], function() use($router) {
        $router->get('/', 'Admin\GeoMlffController@list');
        $router->post('/', 'Admin\GeoMlffController@create');
        $router->put('/', 'Admin\GeoMlffController@update');
        $router->get('d/{geoid}', 'Admin\GeoMlffController@detail');
        $router->get('d/{geoid}/point', 'Admin\GeoMlffController@detail_point');
        $router->get('gate/point', 'Admin\GeoMlffController@gate_point');
        $router->get('gate/section/{section_name}', 'Admin\GeoMlffController@gate_point_section');
        $router->get('gate/section', 'Admin\GeoMlffController@section_point');
        $router->get('gate/point/det/{gate_id}', 'Admin\GeoMlffController@gate_point_section_det');
    });

    $router->group([
        'prefix' => 'tollroute',
        'middleware' => ['root']
    ], function() use($router) {
        $router->get('/', 'Admin\TollRouteController@list');
        $router->post('/', 'Admin\TollRouteController@create');
        $router->put('/', 'Admin\TollRouteController@update');
        $router->get('d/{geoid}', 'Admin\TollRouteController@detail');
        $router->get('d/{geoid}/point', 'Admin\TollRouteController@detail_point');
    });

    $router->group([
        'prefix' => 'info'
    ], function() use($router) {
        $router->get('geo/{geoid}', 'InfoData\IDataController@geo_information');
        $router->get('device/{deviceid}', 'InfoData\IDataController@device_information');
        
    });

    $router->group([
        'prefix' => 'imei',
        'middleware' => ['root']
    ], function() use($router) {
        $router->get('list','Admin\ImeiController@list');
    });

    $router->group([
        'prefix' => 'gate',
        // 'middleware' => ['root']
    ], function() use($router) {
        $router->post('create','Admin\GateController@create');
    });
});

