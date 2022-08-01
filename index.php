<?php
require_once("vendor/autoload.php");

use App\KafkaIntro\ServiceNewOrder\Order;
use App\KafkaIntro\ServiceNewOrder\NewOrder;

for ($i=0; $i <= 10000; $i++) {
    $order = new Order();
    new NewOrder($order);
}