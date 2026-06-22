<?php
namespace App\Entity;

class TransactionEntity
{
    private ?int $id = null;
    private ?string $code = null;
    private float $montant = 0;
    private ?string $dateheure = null;
    private ?string $type = null;
    private ?int $wallet_id = null;
    private ?WalletEntity $wallet = null;

    // Propriétés issues de la jointure SQL
    private ?string $nom = null;
    private ?string $prenom = null;
    private ?string $telephone = null;
    private ?string $wallet_code = null;

    public function getId(): ?int { return $this->id; }
    public function setId(int $id): self { $this->id = $id; return $this; }

    public function getCode(): ?string { return $this->code; }
    public function setCode(string $code): self { $this->code = $code; return $this; }

    public function getMontant(): float { return $this->montant; }
    public function setMontant(float $montant): self { $this->montant = $montant; return $this; }

    public function getDateHeure(): ?string { return $this->dateheure; }
    public function setDateheure(string $dateheure): self { $this->dateheure = $dateheure; return $this; }

    public function getType(): ?string { return $this->type; }
    public function setType(string $type): self { $this->type = $type; return $this; }

    public function getWalletId(): ?int { return $this->wallet_id; }
    public function setWalletId(?int $wallet_id): self { $this->wallet_id = $wallet_id; return $this; }

    public function getWallet(): ?WalletEntity { return $this->wallet; }
    public function setWallet(WalletEntity $wallet): self { $this->wallet = $wallet; return $this; }

    public function getNom(): ?string { return $this->nom; }
    public function setNom(?string $nom): self { $this->nom = $nom; return $this; }

    public function getPrenom(): ?string { return $this->prenom; }
    public function setPrenom(?string $prenom): self { $this->prenom = $prenom; return $this; }

    public function getTelephone(): ?string { return $this->telephone; }
    public function setTelephone(?string $telephone): self { $this->telephone = $telephone; return $this; }

    public function getWalletCode(): ?string { return $this->wallet_code; }
    public function setWalletCode(?string $wallet_code): self { $this->wallet_code = $wallet_code; return $this; }
}