<?php

declare(strict_types=1);

namespace App\Domain\Middleware;

use App\Attributes\ValidateWith;
use App\Facade\App;
use App\Service\RouteService;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

final readonly class ApiMiddleware implements IMiddleware
{
    public function handle(Request $request): void
    {
        $path = rtrim($request->getUrl()->getPath(), '/');
        $method = strtoupper($request->getMethod());

        $routes = RouteService::getRoutes();
        $action = $routes[$path][$method] ?? null;

        if ($action === null) {
            App::jsonResponse("404 Not Found", 404);
        }

        [$controllerClass, $actionMethod] = $action;
        if (!class_exists($controllerClass) || !method_exists($controllerClass, $actionMethod)) {
            App::jsonResponse("Server error", 500);
        }

        $reflectionMethod = new \ReflectionMethod($controllerClass, $actionMethod);
        foreach ($reflectionMethod->getAttributes(ValidateWith::class) as $attribute) {
            $validateWith = $attribute->newInstance();
            $validator = new $validateWith->concrete;

            if (method_exists($validator, 'validate')) {
                $data = $request->getInputHandler()->all();

                $validation = $validator->validate($data);

                if (! empty($validation)) {
                    App::jsonResponse($validation, 403);
                }
            }
        }
    }
}