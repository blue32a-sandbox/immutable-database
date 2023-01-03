<?php

require_once '../../../vendor/autoload.php';

use ImmutableDatabase\Simple\Bill;
use ImmutableDatabase\Lib\Database;

$db = Database::factorySimple();
$bill = new Bill($db->connection());

if (!isset($_GET['id'])) {
    throw new Exception('require id');
}

$orderId = (int) $_GET['id'];
$amountBilled = 12000;
$depositScheduledDate = '2023-02-01';

if ($bill->insert($orderId, $amountBilled, $depositScheduledDate)) {
    echo 'Success!!';
} else {
    echo 'Failed!!';
}
