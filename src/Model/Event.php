<?php

declare(strict_types=1);

namespace App\Model;

final readonly class Event extends BaseModel
{
    public function __construct(
        public int $id,
        public int $userId,
        public string $eventType,
        public int $timestamp,
        public array $metadata,
    ){}
}