<?php

require_once '../../../vendor/autoload.php';

use ImmutableDatabase\Complex\Order;
use ImmutableDatabase\Lib\Database;

$db = Database::factoryComplex();
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
                <td><?php echo $row['order_member_id'] ?></td>
                <td><?php echo $row['order_at'] ?></td>
                <td>
                    <?php if ($row['canceled_at']): ?>
                        キャンセル
                    <?php elseif ($row['deposited_at']): ?>
                        入金済み
                    <?php elseif ($row['billing_at']): ?>
                        請求済み
                    <?php elseif ($row['order_confirmed_at']): ?>
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
