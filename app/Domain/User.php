<?php

namespace App\Domain;

class User
{
    private int $id;
    private string $email;

    private boolean $has_wallet;
    private array $array_wallet;

    public function __construct(int $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
        $this->has_wallet=false;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getWallet(): void{
        $this->has_wallet=true;
        $id=0;
        $wallet = new Wallet($this->id);
        array_push($this->array_wallet,$wallet);
    }
    public function hasUserWallet(): boolean{
        return $this->has_wallet;
    }
}
