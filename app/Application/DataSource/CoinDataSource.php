<?php

namespace App\Application\DataSource;

use App\Domain\Coin;
use App\Domain\User;

Interface CoinDataSource
{
    public function findCoinById(int $id_coin): ?Coin;

    public function updateCoinData(): void;

    public function setUSDValue(): double;

    public function coinExists(): bool;

}

