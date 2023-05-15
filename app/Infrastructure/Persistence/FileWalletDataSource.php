<?php

namespace App\Infrastructure\Persistence;
use App\Application\DataSource\WalletDataSource;
use App\Domain\Coin;
use App\Domain\Wallet;

class FileWalletDataSource implements WalletDataSource
{
    public function findWalletById(string $id_wallet): ?Wallet
    {
        return new Wallet(3);
    }

}
