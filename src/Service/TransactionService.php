<?php
namespace App\Service;

use App\Repository\TransactionRepository;

final class TransactionService
{
    private function __construct()
    {
        throw new \Exception('Not implemented');
    }

    public static function listerTransactions(): array
    {
        $repo = new TransactionRepository();
        return $repo->selectAllWithWallet();
    }
}