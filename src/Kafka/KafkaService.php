<?php

namespace App\KafkaIntro\Kafka;

use longlang\phpkafka\Consumer\ConsumeMessage;
use longlang\phpkafka\Consumer\Consumer;
use longlang\phpkafka\Consumer\ConsumerConfig;

class KafkaService
{
    private $parse;
    private String $groupId;
    private String $topic;

    /**
     * @param String $groupId
     * @param String $topic
     * @param ConsumerFunction $parse
     */
    public function __construct(String $groupId, String $topic, ConsumerFunction $parse)
    {
        $this->parse = $parse;
        $this->groupId = $groupId;
        $this->topic = $topic;
        $this->setConsumer();
    }

    public function commit(ConsumeMessage $message): void
    {
        $this->consumer->ack($message);
    }

    private function configuracao(): ConsumerConfig
    {
        $config = new ConsumerConfig();
        $config->setBroker(['127.0.0.1:9092']);
        $config->setTopic($this->topic);
        $config->setGroupId($this->groupId); // group ID
        $config->setClientId(uniqid('', true)); // client ID. Use different settings for different consumers.
        $config->setGroupInstanceId(uniqid('', true)); // group instance ID. Use different settings for different consumers.
        return $config;
    }

    public function run(): void
    {
        while(true) {
            if ($record = $this->consumer->consume()) {
                $this->parse->consume($record);
            }
        }
    }

    private function setConsumer(): void
    {
        $this->consumer = new Consumer($this->configuracao());
    }
}