<?php

declare(strict_types=1);

namespace App\Trait;

trait Validatable
{
    /**
     * @return array
     */
    protected static function required(): array
    {
        return [
            'rule' => fn($value): bool => !empty($value),
            'message' => 'This field is required.',
        ];
    }

    /**
     * @return array
     */
    protected static function isString(): array
    {
        return [
            'rule' => fn($value): bool => is_string($value),
            'message' => 'This field must be a string.',
        ];
    }

    /**
     * @return array
     */
    protected static function isInt(): array
    {
        return [
            'rule' => fn($value): bool => is_int($value),
            'message' => 'This field must be an integer.',
        ];
    }

    /**
     * @return array
     */
    protected static function isArray(): array
    {
        return [
            'rule' => fn($value): bool => is_array($value),
            'message' => 'This field must be an array.',
        ];
    }

    /**
     * @param int $min
     * @return array
     */
    protected static function minInt(int $min): array
    {
        return [
            'rule' => fn($value): bool => is_int($value) && $value >= $min,
            'message' => "This field must be an integer greater than or equal to {$min}.",
        ];
    }

    /**
     * @param int $max
     * @return array
     */
    protected static function maxInt(int $max): array
    {
        return [
            'rule' => fn($value): bool => is_int($value) && $value <= $max,
            'message' => "This field must be an integer less than or equal to {$max}.",
        ];
    }

    /**
     * @param array $options
     * @return array
     */
    protected static function isInOptions(array $options): array
    {
        return [
            'rule' => fn($value): bool => is_string($value) && in_array($value, $options, true),
            'message' => 'This field must be one of the following: ' . implode(', ', $options) . '.',
        ];
    }

    /**
     * @return array
     */
    protected static function isTimestamp(): array
    {
        return [
            'rule' => fn($value): bool => is_int($value) && $value > 0 && $value <= PHP_INT_MAX,
            'message' => 'This field must be a valid timestamp.',
        ];
    }
}