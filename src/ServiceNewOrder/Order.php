<?php

namespace App\KafkaIntro\ServiceNewOrder;

class Order
{
    public String $userId;
    public String $orderId;
    public float $amount;

    public function __construct()
    {
        $this->userId = "user_id_".date("Ymd_His")."_".rand(100, 9999999);
        $this->orderId = "order_id_".time();
        $this->amount = floatval(rand(1, 500000));
    }
}