<?php

require_once '../../../vendor/autoload.php';

use ImmutableDatabase\Complex\Order;
use ImmutableDatabase\Lib\Database;

$db = Database::factoryComplex();
$order = new Order($db->connection());

if (!isset($_GET['id'])) {
    throw new Exception('require id');
}

$orderId = (int) $_GET['id'];
$orderConfirmedSupervisor = '確認太郎';

if ($order->confirmed($orderId, $orderConfirmedSupervisor)) {
    echo 'Success!!';
} else {
    echo 'Failed!!';
}
