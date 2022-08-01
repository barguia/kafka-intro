<?php

namespace App\KafkaIntro\Kafka;

use longlang\phpkafka\Consumer\ConsumeMessage;

interface ConsumerFunction
{
    public function consume(ConsumeMessage $message);
}