<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([
    'prefix' => 'api',
], function() use($router) {
    $router->group([
        'prefix' => 'devices',
    ], function() use($router) {
        $router->get('/', 'Admin\DeviceController@index');
        $router->post('create', 'Admin\DeviceController@create');
        $router->post('update', 'Admin\DeviceController@update');
        $router->get('list', 'Admin\DeviceController@list');
    });
});