<?php

declare(strict_types=1);

namespace App\Service\Kafka;

use App\Config\BrokerConfig;
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
        $conf = new \RdKafka\Conf();
        $conf->set('bootstrap.servers', BrokerConfig::KAFKA);

        $this->producer = new Producer($conf);
        $this->consumer = new Consumer($conf);
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

            $result = $this->producer->flush(10000);
            if ($result !== RD_KAFKA_RESP_ERR_NO_ERROR) {
                throw new \RuntimeException("Failed to flush Kafka producer: Error code {$result}");
            }
            return true;
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