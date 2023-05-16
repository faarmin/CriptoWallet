<?php

namespace App\Domain;

class Wallet
{
    private int $id_wallet;
    private array $array_coins;
    private double $balance;

    public function __construct(int $id_wallet)
    {
        $this->id_wallet = $id_wallet;
        $this->balance = 0;
    }
    public function getIdUser(): int
    {
        return $this->id_user;
    }
    public function setCoin(): void
    {
        $id_coin = 0;
        $coin = new Coin($id_coin);
        array_push($this->array_coins, $coin);
    }

    public function getWalletContent(): array
    {
        return $this->array_coins;
    }

}
