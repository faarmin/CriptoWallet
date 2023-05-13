<?php

namespace App\Domain;

class User
{
    private int $id;
    private string $email;

    private array $array_wallet;

    public function __construct(int $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getEmail(): string{
        return $this->email;
    }
    public function setWallet(): void{
        $id=0;
        $wallet = new Wallet($id);
        array_push($this->array_wallet,$wallet);
    }
    public function getWallet(): ?array{
        return $this->array_wallet;
    }
}
