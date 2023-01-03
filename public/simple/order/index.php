<?php

require_once '../../../vendor/autoload.php';

use ImmutableDatabase\Simple\Order;
use ImmutableDatabase\Lib\Database;

$db = Database::factorySimple();
$order = new Order($db->connection());

?>
<html lang="ja">
<head>
    <title>注文一覧</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>注文会員</th>
        <th>注文日時</th>
        <th>ステータス</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($order->findAll() as $row): ?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['member_id'] ?></td>
            <td><?php echo $row['ordered_at'] ?></td>
            <td>
                <?php if ($row['order_cancel_id']): ?>
                    キャンセル
                <?php elseif ($row['deposit_id']): ?>
                    入金済み
                <?php elseif ($row['bill_id']): ?>
                    請求済み
                <?php elseif ($row['order_confirm_id']): ?>
                    確認済み
                <?php else: ?>
                    未確認
                <?php endif ?>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
</body>
</html>

