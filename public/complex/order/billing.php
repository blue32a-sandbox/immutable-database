<?php

require_once '../../../vendor/autoload.php';

use ImmutableDatabase\Complex\Order;
use ImmutableDatabase\Lib\Database;

$db = Database::factoryComplex();
$order = new Order($db->connection());

if (!isset($_GET['id'])) {
    throw new Exception('require id');
}

$orderId = $_GET['id'];
$amountBilled = 12000;
$depositScheduledDate = '2023-02-01';
$billingAt = '2023-01-04 13:08:19';

if ($order->billing($orderId, $amountBilled, $depositScheduledDate, $billingAt)) {
    echo 'Success!!';
} else {
    echo 'Failed!!';
}
