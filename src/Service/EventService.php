<?php

namespace App\Service;

use App\Contract\EventStorable;
use App\Model\BaseModel;
use App\Service\Kafka\KafkaClient;

final class EventService implements EventStorable
{
    private static string $eventTopicName = 'events_topic';
    private KafkaClient $kafkaClient;

    public function __construct(KafkaClient $kafkaClient)
    {
        $this->kafkaClient = $kafkaClient;
    }

    public function process(BaseModel $model): void
    {
        $this->kafkaClient->sendEvent($model->toJson(), self::$eventTopicName);
    }

    public function store(BaseModel $model): void
    {
        // TODO Implement store() method.
    }
}