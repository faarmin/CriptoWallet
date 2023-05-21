<?php

namespace App\Infrastructure\Persistence;

use App\Application\DataSource\WalletDataSource;
use App\Domain\Coin;
use App\Domain\Wallet;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */

class CacheWalletDataSource implements WalletDataSource
{
    public function insertWallet(string $id_wallet): Wallet
    {
        $wallet = new Wallet($id_wallet);
        Cache::put("wallet_" . $id_wallet, [$id_wallet,$wallet->getWalletContent()]);
        return $wallet;
    }
    public function findWalletById(string $id_wallet): ?Wallet
    {
        $wallet = Cache::get("wallet_" . $id_wallet);
        $new_wallet = new Wallet($wallet[0]);
        $new_wallet->setCoin($wallet[1]);

        return $new_wallet;
    }
    public function insertNewObjectWallet(Wallet $wallet): void
    {
        $id_wallet = $wallet->getIdWallet();

        Cache::put("wallet_" . $id_wallet, [$id_wallet,$wallet->getWalletContent()]);
    }

    public function walletExists(string $id_wallet): bool
    {
        return Cache::has("wallet_" . $id_wallet);
    }
}
