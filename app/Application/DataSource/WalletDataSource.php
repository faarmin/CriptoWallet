<?php

namespace App\Application\DataSource;

use App\Domain\Wallet;

Interface WalletDataSource
{
    public function insertWallet(string $id_wallet): void;

    public function findWalletById(string $id_wallet): ?Wallet;

    public function walletExists(string $id_wallet): bool;


}

