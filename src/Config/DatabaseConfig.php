<?php

declare(strict_types=1);

namespace App\Config;

final readonly class DatabaseConfig
{
    public const array mongodb = [
        'driver' => 'mongodb',
        'host' => 'localhost',
        'port' => 27017,
        'database' => 'epam_analytics',
    ];
}
