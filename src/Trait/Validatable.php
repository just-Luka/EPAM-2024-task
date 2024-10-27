<?php

declare(strict_types=1);

namespace App\Trait;

trait Validatable
{
    protected static function required(): array
    {
        return [
            'rule' => fn($value): bool => !empty($value),
            'message' => 'This field is required.',
        ];
    }

    protected static function isString(): array
    {
        return [
            'rule' => fn($value): bool => is_string($value),
            'message' => 'This field must be a string.',
        ];
    }

    protected static function isInt(): array
    {
        return [
            'rule' => fn($value): bool => is_int($value),
            'message' => 'This field must be an integer.',
        ];
    }

    protected static function isArray(): array
    {
        return [
            'rule' => fn($value): bool => is_array($value),
            'message' => 'This field must be an array.',
        ];
    }
}