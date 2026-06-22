<?php
namespace App\Repository;

use App\Core\Repository;
use App\Entity\WalletEntity;

class WalletRepository extends Repository
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName   = "wallets";
        $this->entityClass = WalletEntity::class;
    }

    public function insertWallet(WalletEntity $wallet): int
    {
        $sql = "INSERT INTO wallets (code, nom, prenom, telephone, solde) 
                VALUES (:code, :nom, :prenom, :telephone, :solde)";
        return $this->insert($sql, [
            ':code'      => $wallet->getCode(),
            ':nom'       => $wallet->getNom(),
            ':prenom'    => $wallet->getPrenom(),
            ':telephone' => $wallet->getTelephone(),
            ':solde'     => $wallet->getSolde(),
        ]);
    }

    public function selectByTelephone(string $telephone): ?WalletEntity
    {
        try {
            $this->connect();
            $sql = "SELECT * FROM wallets WHERE telephone = :telephone";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':telephone' => $telephone]);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass);
            $result = $stmt->fetch();
            $this->close();
            return $result == false ? null : $result;
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function selectByCode(string $code): ?WalletEntity
    {
        try {
            $this->connect();
            $sql = "SELECT * FROM wallets WHERE code = :code";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':code' => $code]);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass);
            $result = $stmt->fetch();
            $this->close();
            return $result == false ? null : $result;
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function updateSolde(int $id, float $solde): int
    {
        $this->connect();
        $sql = "UPDATE wallets SET solde = :solde WHERE id = :id";
        return $this->insert($sql, [
            ':solde' => $solde,
            ':id'    => $id,
        ]);
    }
}