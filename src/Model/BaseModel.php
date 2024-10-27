<?php

namespace App\Model;

use http\Exception\InvalidArgumentException;

abstract readonly class BaseModel
{
    public function toJson(): string
    {
        return json_encode(get_object_vars($this));
    }

    public static function fromJson(string $json): static
    {
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException('Invalid JSON provided: ' . json_last_error_msg());
        }

        $reflectionClass = new \ReflectionClass(static::class);
        $constructor = $reflectionClass->getConstructor();

        if ($constructor === null) {
            throw new InvalidArgumentException('No constructor found for ' . static::class);
        }

        $parameters = $constructor->getParameters();
        $args = [];

        foreach ($parameters as $parameter) {
            $name = $parameter->getName();
            if (!array_key_exists($name, $data)) {
                throw new InvalidArgumentException("Missing parameter '{$name}' for " . static::class);
            }
            $args[] = $data[$name];
        }

        return $reflectionClass->newInstanceArgs($args);
    }
}