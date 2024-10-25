<?php

declare(strict_types=1);

namespace App\Service\Kafka;

final class EventProducerService
{
    private static string $topic = 'events_topic';

    public function __construct() {}
}