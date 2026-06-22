<?php
namespace App\Controller;

use App\Core\Controller;
use App\Entity\WalletEntity;
use App\Service\WalletService;
use App\Service\TransactionService;

class WalletController extends Controller
{
    public function __construct()
    {
        return parent::__construct();
    }

    public function index(): void
    {
        $transactions = TransactionService::listerTransactions();
        $this->render("wallet/index.php", [
            "transactions" => $transactions,
            "errors"       => $_SESSION['errors'] ?? [],
            "success"      => $_SESSION['success'] ?? null,
        ]);
        unset($_SESSION['errors'], $_SESSION['success']);
    }

    public function creerWallet(): void
    {
        $code      = trim($_POST['code'] ?? '');
        $nom       = trim($_POST['nom'] ?? '');
        $prenom    = trim($_POST['prenom'] ?? '');
        $telephone = trim($_POST['telephone'] ?? '');
        $solde     = $_POST['solde'] ?? 0;

        $errors = [];

        if (empty($code))      $errors['code']      = "Le code est obligatoire.";
        if (empty($nom))       $errors['nom']        = "Le nom est obligatoire.";
        if (empty($prenom))    $errors['prenom']     = "Le prénom est obligatoire.";
        if (empty($telephone)) $errors['telephone']  = "Le téléphone est obligatoire.";
        if ($solde < 0)        $errors['solde']      = "Le solde doit être positif ou nul.";

        // Vérifier unicité code et téléphone
        if (empty($errors['code']) && WalletService::findByCode($code)) {
            $errors['code'] = "Ce code est déjà utilisé.";
        }
        if (empty($errors['telephone']) && WalletService::findByTelephone($telephone)) {
            $errors['telephone'] = "Ce numéro est déjà associé à un wallet.";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->redirectUrl('wallet/index');
            return;
        }

        $wallet = new WalletEntity();
        $wallet->setCode($code);
        $wallet->setNom($nom);
        $wallet->setPrenom($prenom);
        $wallet->setTelephone($telephone);
        $wallet->setSolde((float)$solde);

        WalletService::creerWallet($wallet);

        $_SESSION['success'] = "Wallet créé avec succès.";
        $this->redirectUrl('wallet/index');
    }

    public function depot(): void
    {
        $telephone = trim($_POST['telephone_depot'] ?? '');
        $montant   = (float)($_POST['montant_depot'] ?? 0);

        $result = WalletService::faireDepot($telephone, $montant);

        if (!$result['success']) {
            $_SESSION['errors']['depot'] = $result['error'];
        } else {
            $_SESSION['success'] = "Dépôt de " . number_format($montant, 0, ',', ' ') . " CFA effectué avec succès.";
        }

        $this->redirectUrl('wallet/index');
    }

    public function retrait(): void
    {
        $telephone = trim($_POST['telephone_retrait'] ?? '');
        $montant   = (float)($_POST['montant_retrait'] ?? 0);

        $result = WalletService::faireRetrait($telephone, $montant);

        if (!$result['success']) {
            $_SESSION['errors']['retrait'] = $result['error'];
        } else {
            $frais = number_format($result['frais'], 0, ',', ' ');
            $_SESSION['success'] = "Retrait effectué avec succès. Frais : {$frais} CFA.";
        }

        $this->redirectUrl('wallet/index');
    }
}