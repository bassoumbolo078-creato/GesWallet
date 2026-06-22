<?php
namespace App\Core;

class Repository
{
    protected ?\PDO $pdo = null;
    protected string $entityClass;
    protected string $tableName;

    public function __construct()
    {
        $this->connect();
    }

    public function connect(): void
    {
        $host = 'localhost';
        $port = 5432;
        $db = 'wallet';
        $user = 'postgres';
        $pass = '101210';

        try {
            if ($this->pdo === null) {
                $this->pdo = new \PDO(
                    "pgsql:host=$host;port=$port;dbname=$db",
                    $user,
                    $pass,
                    [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
                );
            }
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function close(): void
    {
        $this->pdo = null;
    }

    public function selectAll(): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
            $stmt->execute();
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS, $this->entityClass);
            $this->close();
            return $results;
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            $this->close();
            return [];
        }
    }

  protected function insert(string $sql, array $params): int
{
    try {
        $this->connect(); // ← ajouter
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $this->close();
        return $stmt->rowCount();
    } catch (\PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return 0;
    }

    }
}