<?php

namespace App\Infrastructure\Persistence;

class FileWalletCoinDataSource
{
    public function __invoke( )
    {
        Schema::create('walletCoin', function($table)
        {
            $table->string('key')->primary();
            $table->string('wallet_id')->foreign();
            $table->string('coin_id')->foreign();
            $table->double('amount');
            $table->integer('expiration');
        });
    }


}
