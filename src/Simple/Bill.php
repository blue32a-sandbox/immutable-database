<?php

namespace ImmutableDatabase\Simple;

use PDO;

readonly class Bill
{
    public function __construct(private PDO $connection)
    {
    }

    public function insert(int $orderId, int $amountBilled, string $depositScheduledDate): bool
    {
        $sql = <<<SQL
INSERT INTO `bill` (
    order_id,
    amount_billed,
    deposit_scheduled_date,
    billed_at
) VALUES (
    :order_id,
    :amount_billed,
    :deposit_scheduled_date,
    NOW()
)
SQL;
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':order_id', $orderId);
        $stmt->bindValue(':amount_billed', $amountBilled);
        $stmt->bindValue(':deposit_scheduled_date', $depositScheduledDate);

        return $stmt->execute();
    }
}