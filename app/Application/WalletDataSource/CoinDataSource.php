<?php

namespace App\Application\DataSource;

use App\Domain\Coin;
use App\Domain\User;

Interface CoinDataSource
{
    public function findCoinById(int $id): ?Coin;
}
