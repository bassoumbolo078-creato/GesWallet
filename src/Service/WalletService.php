<?php
namespace App\Service;

use App\Entity\WalletEntity;
use App\Entity\TransactionEntity;
use App\Repository\WalletRepository;
use App\Repository\TransactionRepository;

final class WalletService
{
    private function __construct()
    {
        throw new \Exception('Not implemented');
    }

    public static function creerWallet(WalletEntity $wallet): bool
    {
        $repo = new WalletRepository();
        return $repo->insertWallet($wallet) > 0;
    }

    public static function findByTelephone(string $telephone): ?WalletEntity
    {
        $repo = new WalletRepository();
        return $repo->selectByTelephone($telephone);
    }

    public static function findByCode(string $code): ?WalletEntity
    {
        $repo = new WalletRepository();
        return $repo->selectByCode($code);
    }

    public static function faireDepot(string $telephone, float $montant): array
    {
        $repo   = new WalletRepository();
        $wallet = $repo->selectByTelephone($telephone);

        if ($wallet === null) {
            return ['success' => false, 'error' => "Aucun wallet trouvé pour ce numéro."];
        }

        if ($montant <= 0) {
            return ['success' => false, 'error' => "Le montant doit être positif."];
        }

        $nouveauSolde = $wallet->getSolde() + $montant;
        $repo->updateSolde($wallet->getId(), $nouveauSolde);

        // Créer la transaction
        $transaction = new TransactionEntity();
        $transaction->setCode('TRX-' . strtoupper(uniqid()));
        $transaction->setMontant($montant);
        $transaction->setType('DEPOT');
        $transaction->setWalletId($wallet->getId());
        $transaction->setDateheure(date('Y-m-d H:i:s'));

        $transRepo = new TransactionRepository();
        $transRepo->insertTransaction($transaction);

        return ['success' => true];
    }

    public static function faireRetrait(string $telephone, float $montant): array
    {
        $repo   = new WalletRepository();
        $wallet = $repo->selectByTelephone($telephone);

        if ($wallet === null) {
            return ['success' => false, 'error' => "Aucun wallet trouvé pour ce numéro."];
        }

        if ($montant <= 0) {
            return ['success' => false, 'error' => "Le montant doit être positif."];
        }

        // Frais de retrait = 1% plafonné à 5000 CFA
        $frais        = min($montant * 0.01, 5000);
        $totalRetrait = $montant + $frais;

        if ($totalRetrait > $wallet->getSolde()) {
            return ['success' => false, 'error' => "Solde insuffisant. Solde disponible : " . number_format($wallet->getSolde(), 0, ',', ' ') . " CFA (frais inclus : " . number_format($frais, 0, ',', ' ') . " CFA)."];
        }

        $nouveauSolde = $wallet->getSolde() - $totalRetrait;
        $repo->updateSolde($wallet->getId(), $nouveauSolde);

        // Créer la transaction
        $transaction = new TransactionEntity();
        $transaction->setCode('TRX-' . strtoupper(uniqid()));
        $transaction->setMontant($montant);
        $transaction->setType('RETRAIT');
        $transaction->setWalletId($wallet->getId());
        $transaction->setDateheure(date('Y-m-d H:i:s'));

        $transRepo = new TransactionRepository();
        $transRepo->insertTransaction($transaction);

        return ['success' => true, 'frais' => $frais];
    }
}