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
$depositAmount = 12000;
$depositedAt = '2023-02-01 10:22:06';
$depositor = '入金花子';

if ($order->deposit($orderId, $depositAmount, $depositedAt, $depositor)) {
    echo 'Success!!';
} else {
    echo 'Failed!!';
}
