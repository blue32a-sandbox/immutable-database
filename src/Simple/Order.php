<?php

namespace ImmutableDatabase\Simple;

use PDO;
use PDOStatement;

readonly class Order
{
    public function __construct(private PDO $connection)
    {
    }

    public function findAll(): false|PDOStatement
    {
        $sql = <<<SQL
SELECT
    `order`.`id`,
    `order`.`member_id`,
    `order`.`amount`,
    `order`.`ordered_at`,
    `order_cancel`.`id` as order_cancel_id,
    `order_cancel`.`canceled_at`,
    `order_confirm`.`id` as order_confirm_id,
    `order_confirm`.`supervisor` as order_confirm_supervisor,
    `order_confirm`.`confirmed_at`,
    `bill`.`id` as bill_id,
    `bill`.`amount_billed`,
    `bill`.`deposit_scheduled_date`,
    `bill`.`billed_at`,
    `deposit`.`id` as deposit_id,
    `deposit`.`amount` as deposit_amount,
    `deposit`.`depositor`,
    `deposit`.`deposited_at`
FROM `order`
LEFT JOIN `order_cancel` ON `order_cancel`.`order_id` = `order`.`id`
LEFT JOIN `order_confirm` ON `order_confirm`.`order_id` = `order`.`id`
LEFT JOIN `bill` ON `bill`.`order_id` = `order`.`id`
LEFT JOIN `deposit` ON `deposit`.`bill_id` = `bill`.`id`
ORDER BY `order`.`id`
SQL;
        return $this->connection->query($sql);
    }

    public function insert(int $memberId, int $amount): bool
    {
        $sql = <<<SQL
INSERT INTO `order` (
    member_id,
    amount,                 
    ordered_at
) VALUES (
    :member_id,
    :amount,
    NOW()
)
SQL;
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':member_id', $memberId);
        $stmt->bindValue(':amount', $amount);

        return $stmt->execute();
    }
}
