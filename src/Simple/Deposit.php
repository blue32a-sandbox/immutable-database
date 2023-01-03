<?php

namespace ImmutableDatabase\Simple;

use PDO;

readonly class Deposit
{
    public function __construct(private PDO $connection)
    {
    }

    public function insert(int $billId, int $amount, string $depositor): bool
    {
        $sql = <<<SQL
INSERT INTO `deposit` (
    bill_id,
    amount,
    depositor,
    deposited_at
) VALUES (
    :bill_id,
    :amount,
    :depositor,
    NOW()
)
SQL;
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':bill_id', $billId);
        $stmt->bindValue(':amount', $amount);
        $stmt->bindValue(':depositor', $depositor);

        return $stmt->execute();
    }
}