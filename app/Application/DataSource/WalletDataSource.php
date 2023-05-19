<?php

namespace App\Application\DataSource;

use App\Domain\Coin;
use App\Domain\Wallet;
use Illuminate\Http\JsonResponse;

interface WalletDataSource
{
    public function insertWallet(string $id_wallet): Wallet;

    public function findWalletById(string $id_wallet): bool;

    public function sellCoin(Coin $coin, string $id_wallet): bool;
}
