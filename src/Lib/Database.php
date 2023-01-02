<?php

namespace ImmutableDatabase\Lib;

use PDO;

readonly class Database
{
    private string $host;
    private string $user;
    private string $password;

    public function __construct(private string $database)
    {
        $this->host = 'mysql';
        $this->user = 'root';
        $this->password = 'examplepw';
    }

    public function connection(): PDO
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s', $this->host, $this->database);
        return new PDO($dsn, $this->user, $this->password);
    }

    public static function factoryComplex(): self
    {
        return new self('complex');
    }
}