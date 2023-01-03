<?php

require_once '../../../vendor/autoload.php';

use ImmutableDatabase\Simple\OrderConfirm;
use ImmutableDatabase\Lib\Database;

$db = Database::factorySimple();
$orderConfirm = new OrderConfirm($db->connection());

if (!isset($_GET['id'])) {
    throw new Exception('require id');
}

$orderId = (int) $_GET['id'];
$supervisor = '確認太郎';

if ($orderConfirm->insert($orderId, $supervisor)) {
    echo 'Success!!';
} else {
    echo 'Failed!!';
}
