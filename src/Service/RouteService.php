<?php

declare(strict_types=1);

namespace App\Service;

final class RouteService
{
    private static array $routes = [];

    private function __construct() {}

    public static function setRoutes(array $routes): void
    {
        self::$routes = $routes;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }
}