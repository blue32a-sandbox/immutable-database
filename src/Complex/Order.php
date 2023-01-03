<?php

namespace ImmutableDatabase\Complex;

use PDO;
use PDOStatement;

readonly class Order
{
    public function __construct(private PDO $connection)
    {
    }

    public function findAll(): false|PDOStatement
    {
        return $this->connection->query('SELECT * FROM `order` ORDER BY id');
    }

    public function insert(int $orderMemberId, string $orderedAt, int $orderAmount): bool
    {
        $sql = <<<SQL
INSERT INTO `order` (
    order_member_id,
    ordered_at,
    order_amount,
    registered_at
) VALUES (
    :order_member_id,
    :ordered_at,
    :order_amount,
    NOW()
)
SQL;
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':order_member_id', $orderMemberId);
        $stmt->bindValue(':ordered_at', $orderedAt);
        $stmt->bindValue(':order_amount', $orderAmount);

        return $stmt->execute();
    }

    public function confirmed(int $id, string $orderConfirmedSupervisor): bool
    {
        $sql = <<<SQL
UPDATE `order`
SET `order_confirmed_supervisor` = :order_confirmed_supervisor,
    `order_confirmed_at` = NOW(),
    `updated_at` = NOW()
WHERE `id` = :id
SQL;
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':order_confirmed_supervisor', $orderConfirmedSupervisor);

        return $stmt->execute();
    }

    public function billing(
        int $id,
        string $amountBilled,
        string $depositScheduledDate,
        string $billedAt
    ): bool {
        $sql = <<<SQL
UPDATE `order`
SET `amount_billed` = :amount_billed,
    `deposit_scheduled_date` = :deposit_scheduled_date,
    `billed_at` = :billed_at,
    `updated_at` = NOW()
WHERE `id` = :id
SQL;
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':amount_billed', $amountBilled);
        $stmt->bindValue(':deposit_scheduled_date', $depositScheduledDate);
        $stmt->bindValue(':billed_at', $billedAt);

        return $stmt->execute();
    }

    public function deposit(
        int $id,
        int $depositAmount,
        string $depositedAt,
        string $depositor
    ): bool {
        $sql = <<<SQL
UPDATE `order`
SET `deposit_amount` = :deposit_amount,
    `deposited_at` = :deposited_at,
    `depositor` = :depositor,
    `updated_at` = NOW()
WHERE `id` = :id
SQL;
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':deposit_amount', $depositAmount);
        $stmt->bindValue(':deposited_at', $depositedAt);
        $stmt->bindValue(':depositor', $depositor);

        return $stmt->execute();
    }

    public function canceled(int $id): bool
    {
        $sql = <<<SQL
UPDATE `order`
SET `canceled_at` = NOW()
WHERE `id` = :id
SQL;
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }
}