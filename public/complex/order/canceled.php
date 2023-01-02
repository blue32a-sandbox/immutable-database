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

if ($order->canceled($orderId)) {
    echo 'Success!!';
} else {
    echo 'Failed!!';
}
