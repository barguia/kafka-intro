<?php

namespace App\KafkaIntro\ServiceEmail;

use App\KafkaIntro\Kafka\ConsumerFunction;
use App\KafkaIntro\Kafka\KafkaService;
use longlang\phpkafka\Consumer\ConsumeMessage;

class EmailService implements ConsumerFunction
{
    private $service;
    public function __construct()
    {
        $this->service = new KafkaService(
            "EmailService",
            'ECOMMERCE_NEW_ORDER',
            $this
        );

        $this->service->run();
    }

    public function consume(ConsumeMessage $message)
    {
        echo "------------------------------------------". PHP_EOL;
        echo "Send email".PHP_EOL;
        echo "E-mail sent".PHP_EOL;
        var_dump(date("H:i:s_").$message->getKey());
        var_dump($message->getValue());
        $this->service->commit($message);
    }
}