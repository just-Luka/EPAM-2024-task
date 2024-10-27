<?php

declare(strict_types=1);

use App\Domain\Middleware\ApiMiddleware;
use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter;

$api = require_once __DIR__ . '/api.php';

\App\Service\RouteService::setRoutes($api);

SimpleRouter::group(['middleware' => ApiMiddleware::class], static function () use ($api): void {
    foreach ($api as $path => $methods) {
        foreach ($methods as $method => $action) {
            switch ($method) {
                case 'GET':
                    SimpleRouter::get($path, $action);
                    break;
                case 'POST':
                    SimpleRouter::post($path, $action);
                    break;
                case 'PUT':
                    SimpleRouter::put($path, $action);
                    break;
                case 'DELETE':
                    SimpleRouter::delete($path, $action);
                    break;
                default:
                    throw new Exception("Unsupported HTTP method: $method");
            }
        }
    }
});

SimpleRouter::error(function(Request $request, \Exception $exception) {
   \App\Facade\App::jsonResponse("404 not found!", 404);
});


SimpleRouter::start();