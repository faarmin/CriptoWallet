<?php

namespace App\Application\DataSource;

use App\Domain\Coin;
use App\Domain\User;

interface CoinDataSource
{
    public function buyCoin(string $id_coin, float $amount): ?Coin;

    //public function returnUSDValue(string $id_coin, float $amount): float;
}
