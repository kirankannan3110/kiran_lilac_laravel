<?php

// Load Composer's autoloader
require __DIR__.'/../vendor/autoload.php';

// Bootstrapping the application
$app = require_once __DIR__.'/../bootstrap/app.php';

// Handling the HTTP request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
