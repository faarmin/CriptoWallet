<?php

namespace App\Domain;

class Wallet
{
    private int $id_user;
    private array $array_coins;
    public function __construct(int $id)
    {
        $this->id_user = $id;
    }
    public function getIdUser(): int
    {
        return $this->id_user;
    }
    public function setCoin(): void{
        $id=0;
        $coin = new Coin($id);
        array_push($this->array_coins,$coin);
    }
    public function getWallet(): array{
        return $this->array_wallet;
    }
}
