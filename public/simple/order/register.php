<?php

require_once '../../../vendor/autoload.php';

use ImmutableDatabase\Simple\Order;
use ImmutableDatabase\Lib\Database;

$db = Database::factorySimple();
$order = new Order($db->connection());

$memberId = 1;
$amount = 12000;

if ($order->insert($memberId, $amount)) {
    echo 'Success!!';
} else {
    echo 'Failed!!';
}
