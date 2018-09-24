<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('testdatabase', function () use ($router) {
    try {
        DB::connection()->getPdo();
        if(DB::connection()->getDatabaseName()){
            return "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName();
        }
    } catch (\Exception $e) {
        die("Could not connect to the database: " . $e->getMessage());
    }
});

$router->get('testcache', function () use ($router) {
    try {
        echo 'Setting User key...<br />';
        app('redis')->set('user', 'Juan Dela Cruz');
        echo 'User key value: ' . app('redis')->get('user') . '<br />';
        echo 'Removing User key.';
        app('redis')->del('user');
    } catch (\Exception $e) {
        die('Could not connect to the cache: ' . $e->getMessage());
    }
});