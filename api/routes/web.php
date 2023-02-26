<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([
    'prefix' => 'api',
], function() use($router) {
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
    });

    $router->group([
        'prefix' => 'geo'
    ], function() use($router) {
        $router->get('/', 'Admin\GeoController@list');
        $router->post('/', 'Admin\GeoController@create');
    });
});

