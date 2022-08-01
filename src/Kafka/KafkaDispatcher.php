<?php

namespace App\KafkaIntro\Kafka;

use longlang\phpkafka\Producer\ProducerConfig;
use longlang\phpkafka\Producer\Producer;

class KafkaDispatcher
{
    private Producer $producer;
    public function __construct()
    {
        $this->producer = new Producer($this->configuracao());
    }

    private function configuracao(): ProducerConfig
    {
        $config = new ProducerConfig();
        $config->setBootstrapServer('127.0.0.1:9092');
        $config->setUpdateBrokers(true);
        $config->setAcks(-1);
        return $config;
    }

    public function send(String $topic, String $key, $value, array $headers = [])
    {
        $this->producer->send($topic, serialize($value), $key, $headers);
    }
}