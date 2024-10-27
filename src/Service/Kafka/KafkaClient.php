<?php

declare(strict_types=1);

namespace App\Service\Kafka;

use RdKafka\Producer;
use RdKafka\Consumer;
use RdKafka\TopicConf;

final class KafkaClient
{
    private static ?self $instance = null;
    private Producer $producer;
    private Consumer $consumer;

    private function __construct()
    {
        $this->producer = new Producer();
        $this->consumer = new Consumer();
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function sendEvent(string $payload, string $topic): bool
    {
        try {
            $producerTopicConf = new TopicConf();
            $producerTopic = $this->producer->newTopic($topic, $producerTopicConf);
            $producerTopic->produce(RD_KAFKA_PARTITION_UA, 0, $payload);
            $this->producer->poll(0);

            // Wait for message delivery
            return $this->producer->flush(10000) === RD_KAFKA_RESP_ERR_NO_ERROR;
        } catch (\Exception $e) {
            error_log("Failed to send event: " . $e->getMessage());
            return false;
        }
    }

    public function consumeEvents(callable $callback): void
    {
        // Logic to consume events from Kafka and execute callback
    }
}