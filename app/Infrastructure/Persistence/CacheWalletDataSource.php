<?php

namespace App\Infrastructure\Persistence;

use App\Application\DataSource\WalletDataSource;
use App\Domain\Coin;
use App\Domain\Wallet;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

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
        return Cache::get($id_wallet);
    }


    public function walletExists(string $id_wallet): bool
    {
        return Cache::has($id_wallet);//!=null;
    }
}
