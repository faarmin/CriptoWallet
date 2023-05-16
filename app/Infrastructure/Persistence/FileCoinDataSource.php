<?php

namespace App\Infrastructure\Persistence;

use App\Application\DataSource\CoinDataSource;
use App\Domain\Coin;

class FileCoinDataSource implements CoinDataSource
{
    public function __invoke()
    {
        Schema::create('coin', function($table)
        {
            $table->string('coin_id')->unique();
            $table->string('name');
            $table->string('symbol');
            $table->double('value_usd');
            $table->integer('expiration');
        });
    }
    public function findCoinById(int $id_coin): ?Coin
    {
        return new Coin(3);
    }
}
