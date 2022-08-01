<?php

namespace App\KafkaIntro\ServiceNewOrder;

use App\KafkaIntro\Kafka\KafkaDispatcher;

class NewOrder
{
    public function __construct(Order $order)
    {
        $key = "key_".time();
        $dispatcher = new KafkaDispatcher();
        $dispatcher->send("ECOMMERCE_NEW_ORDER", $key, $order);
    }
}