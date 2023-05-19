<?php

namespace App\Application\DataSource;

use App\Domain\Coin;
use App\Domain\User;

Interface CoinDataSource
{
    public function insertCoin(string $id_coin, string $symbol, string $name, float $value_usd): ?Coin;

    public function findCoinById(string $id_coin): ?Coin;

    public function updateCoinData(): void;

    public function returnUSDValue(string $id_coin, float $amount): float;

    public function coinExists(string $id_coin): bool;

}

