<?php

require_once '../../../vendor/autoload.php';

use ImmutableDatabase\Simple\OrderCancel;
use ImmutableDatabase\Lib\Database;

$db = Database::factorySimple();
$orderCancel = new OrderCancel($db->connection());

if (!isset($_GET['id'])) {
    throw new Exception('require id');
}

$orderId = (int) $_GET['id'];

if ($orderCancel->insert($orderId)) {
    echo 'Success!!';
} else {
    echo 'Failed!!';
}
