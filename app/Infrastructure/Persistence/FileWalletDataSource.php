<?php

namespace App\Infrastructure\Persistence;
use App\Application\DataSource\WalletDataSource;
use App\Domain\Coin;
use App\Domain\Wallet;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Cache;
>>>>>>> 12ec46907c87fd4aa14dd340c907bd4d7a65541e
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
