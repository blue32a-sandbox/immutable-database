<?php

require_once '../../../vendor/autoload.php';

use ImmutableDatabase\Complex\Order;
use ImmutableDatabase\Lib\Database;

$db = Database::factoryComplex();
$order = new Order($db->connection());

$orderMemberId = 1;
$orderedAt = date('Y-m-d H:i:s');
$orderAmount = 12000;

if ($order->insert($orderMemberId, $orderedAt, $orderAmount)) {
    echo 'Success!!';
} else {
    echo 'Failed!!';
}
