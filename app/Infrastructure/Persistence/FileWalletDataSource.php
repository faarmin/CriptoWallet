<?php

namespace App\Infrastructure\Persistence;
use App\Application\DataSource\WalletDataSource;
use App\Domain\Coin;
use App\Domain\Wallet;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class FileWalletDataSource implements WalletDataSource
{


    public function __invoke( )
    {
        Schema::create('wallet', function($table)
        {
            $table->string('wallet_id')->unique();
            $table->double('balance_usd');
            $table->integer('expiration');
        });
    }

    public function insertWallet(string $id_wallet): void
    {
        Cache::put($id_wallet,0);
    }

    public function findWalletById(string $id_wallet): ?Wallet
    {
        return Cache::get($id_wallet);
    }


    public function walletExists(String $id_wallet): bool
    {
        return Cache::has($id_wallet);
    }



}
