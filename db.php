<?php

class Database {
    private PDO $pdo;

    public function __construct(string $dsn, string $username, string $password) {
        $this->connect($dsn, $username, $password);
    }

    private function connect(string $dsn, string $username, string $password): void {
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_PERSISTENT         => false
        ];

        $this->pdo = new PDO($dsn, $username, $password, $options);
    }

    public function fetchAll(string $sql, array $params = []): array {
        return $this->execute($sql, $params)->fetchAll();
    }

    public function fetchOne(string $sql, array $params = []): ?array {
        $result = $this->execute($sql, $params)->fetch();
        return $result === false ? null : $result;
    }

    public function fetchValue(string $sql, array $params = []): mixed {
        $row = $this->fetchOne($sql, $params);
        return $row ? array_values($row)[0] : null;
    }

    public function insert(string $table, array $data): int {
        $columns = array_keys($data);
        $placeholders = array_map(fn($key) => ":$key", $columns);
        
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $table,
            implode(', ', $columns),
            implode(', ', $placeholders)
        );

        $this->execute($sql, $data);
        return (int)$this->pdo->lastInsertId();
    }

    public function executeRaw(string $sql): bool {
        return $this->pdo->exec($sql) !== false;
    }

    public function delete(string $sql, array $params = []): int {
        $stmt = $this->execute($sql, $params);
        return $stmt->rowCount();
    }

    private function execute(string $sql, array $params): PDOStatement {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function getConnection(): PDO {
        return $this->pdo;
    }
}
