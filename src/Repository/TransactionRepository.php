<?php
namespace App\Repository;

use App\Core\Repository;
use App\Entity\TransactionEntity;

class TransactionRepository extends Repository
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName   = "transactions";
        $this->entityClass = TransactionEntity::class;
    }

    public function insertTransaction(TransactionEntity $transaction): int
    {
        $sql = "INSERT INTO transactions (code, montant, dateheure, type, wallet_id) 
                VALUES (:code, :montant, :dateheure, :type, :wallet_id)";
        return $this->insert($sql, [
            ':code'      => $transaction->getCode(),
            ':montant'   => $transaction->getMontant(),
            ':dateheure' => $transaction->getDateHeure() ?? date('Y-m-d H:i:s'),
            ':type'      => $transaction->getType(),
            ':wallet_id' => $transaction->getWalletId(),
        ]);
    }

    public function selectAllWithWallet(): array
    {
        try {
            $this->connect();
            $sql = "SELECT t.*, w.nom, w.prenom, w.telephone, w.code as wallet_code
                    FROM transactions t
                    LEFT JOIN wallets w ON t.wallet_id = w.id
                    ORDER BY t.dateheure DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS, $this->entityClass);
            $this->close();
            return $results;
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}