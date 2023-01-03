<?php

require_once '../../../vendor/autoload.php';

use ImmutableDatabase\Simple\Deposit;
use ImmutableDatabase\Lib\Database;

$db = Database::factorySimple();
$deposit = new Deposit($db->connection());

if (!isset($_GET['id'])) {
    throw new Exception('require id');
}

$billId = (int) $_GET['id'];
$amount = 12000;
$depositor = '入金花子';

if ($deposit->insert($billId, $amount, $depositor)) {
    echo 'Success!!';
} else {
    echo 'Failed!!';
}
