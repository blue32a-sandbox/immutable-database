<?php

namespace ImmutableDatabase\Simple;

use PDO;

readonly class OrderConfirm
{
    public function __construct(private PDO $connection)
    {
    }

    public function insert(int $orderId, string $supervisor): bool
    {
        $sql = <<<SQL
INSERT INTO `order_confirm` (
    order_id,
    supervisor,                 
    confirmed_at
) VALUES (
    :order_id,
    :supervisor,
    NOW()
)
SQL;
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':order_id', $orderId);
        $stmt->bindValue(':supervisor', $supervisor);

        return $stmt->execute();
    }
}