<?php

namespace App\Application\DataSource;

use App\Domain\Wallet;

interface WalletDataSource
{
    public function insertWallet(string $id_wallet): Wallet;

    public function findWalletById(string $id_wallet): ?Wallet;

    public function walletExists(string $id_wallet): bool;

    public function getWalletCoins(string $id_wallet): array;
}
