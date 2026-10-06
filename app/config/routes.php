<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$router->get('/','Welcome::index' );
// Login
$router->get('/login', 'AuthController::login');
$router->post('/login', 'AuthController::login');

// Logout
$router->get('/logout', 'AuthController::logout');

// Product CRUD
$router->get('/products', 'ProductController::index')
       ->middleware('product');

$router->get('/products/create', 'ProductController::create')
       ->middleware('product');

$router->post('/products/store', 'ProductController::store')
       ->middleware('product');

$router->get('/products/edit/{id}', 'ProductController::edit')
       ->where_number('id')
       ->middleware('product');

$router->post('/products/update/{id}', 'ProductController::update')
       ->where_number('id')
       ->middleware('product');

$router->post('/products/delete/{id}', 'ProductController::delete')
       ->where_number('id');


       // ===== REST API (React frontend) =====
$router->post('/api/login',   'ApiAuthController::login');
$router->post('/api/refresh', 'ApiAuthController::refresh');
$router->post('/api/logout',  'ApiAuthController::logout');

$router->get('/api/products',               'ApiProductController::index');
$router->get('/api/products/{id}',          'ApiProductController::show')->where_number('id');
$router->post('/api/products',              'ApiProductController::store');
$router->put('/api/products/{id}',          'ApiProductController::update')->where_number('id');
$router->patch('/api/products/{id}',        'ApiProductController::update')->where_number('id');
$router->delete('/api/products/{id}',       'ApiProductController::delete')->where_number('id');

// Browser "preflight" (CORS) requests. The Api library answers these automatically.
$router->options('/api/login',          'ApiAuthController::login');
$router->options('/api/refresh',        'ApiAuthController::refresh');
$router->options('/api/logout',         'ApiAuthController::logout');
$router->options('/api/products',       'ApiProductController::index');
$router->options('/api/products/{id}',  'ApiProductController::show')->where_number('id');

// ===== Migration routes: command line only (never reachable from the web) =====
if (defined('IS_CLI') && IS_CLI) {
    $router->get('create-migration/{migration_class}', 'MigrationController::create_migration');
    $router->get('migrate',      'MigrationController::migrate');
    $router->get('rollback',     'MigrationController::rollback');
    $router->get('rollback-all', 'MigrationController::rollback_all');
    $router->get('refresh',      'MigrationController::refresh');
    $router->get('status',       'MigrationController::status');
}