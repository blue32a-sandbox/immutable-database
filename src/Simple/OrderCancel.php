<?php

namespace ImmutableDatabase\Simple;

use PDO;

readonly class OrderCancel
{
    public function __construct(private PDO $connection)
    {
    }

    public function insert(int $orderId): bool
    {
        $sql = <<<SQL
INSERT INTO `order_cancel` (
    order_id,
    canceled_at
) VALUES (
    :order_id,
    NOW()
)
SQL;
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':order_id', $orderId);

        return $stmt->execute();
    }
}