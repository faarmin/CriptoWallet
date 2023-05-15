<?php

namespace App\Infrastructure\Persistence;

use App\Application\DataSource\CoinDataSource;
use App\Domain\Coin;

class FileCoinDataSource implements CoinDataSource
{
    public function findCoinById(int $id_coin): ?Coin
    {
        return new Coin(3);
    }
}
