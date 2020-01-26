<?php
require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$app = new \Slim\App(\App\v1\Config\Settings::get());

// Set up dependencies
$dependencies = new \App\v1\Config\Dependencies($app);
$dependencies->make();

// Register routes
$routes = new \App\v1\Config\Routes($app);
$routes->make();

$app->add(new Tuupola\Middleware\CorsMiddleware);

// Run app
$app->run();

