<?php

namespace App\Domain;

use PhpParser\Node\Expr\Cast\Double;

class Wallet
{
    private string $id_wallet;
    private array $array_coins;
    public function __construct(string $id_wallet)
    {
        $this->id_wallet = $id_wallet;
        $this->array_coins=[];
    }
    public function getIdWallet(): string
    {
        return $this->id_wallet;
    }
    public function setCoin(): void
    {
        $id_coin = 0;
        $coin = new Coin($id_coin);
        $this->array_coins[] = $coin;
    }

    public function getWalletContent(): array
    {
        return $this->array_coins;
    }
}
