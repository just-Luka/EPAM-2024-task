<?php

declare(strict_types=1);

namespace App\Facade;

use JetBrains\PhpStorm\NoReturn;

final readonly class App
{
    #[noReturn] public static function jsonResponse(mixed $data, int $statusCode = 200, array $headers = ['Content-Type' => 'application/json']): void
    {
        http_response_code($statusCode);
        foreach ($headers as $key => $value) {
            header("{$key}: {$value}");
        }

        try {
            $json = json_encode($data, JSON_THROW_ON_ERROR);
            echo $json;
        } catch (\JsonException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to encode JSON data.']);
        }

        exit;
    }
}