<?php

namespace App\Infrastructure\Persistence;

use App\Application\DataSource\CoinDataSource;
use App\Domain\Coin;
use Illuminate\Support\Facades\Cache;

class CacheCoinDataSource implements CoinDataSource
{
    public function insertCoin(string $id_coin, string $symbol, string $name, float $value_usd): ?Coin
    {
        $new_coin = new Coin("coin_".$id_coin,$symbol,$name,$value_usd);
        Cache::put("coin_".$id_coin,["coin_".$id_coin,$symbol,$name,$value_usd]);
        return $new_coin;
    }

    public function findCoinById(string $id_coin): ?Coin
    {
        return Cache::get('coin_' . $id_coin);;
    }

    public function updateCoinData(): void
    {
        // TODO: Implement updateCoinData() method.
    }

    public function coinExists(string $id_coin): bool
    {
        return Cache::has('coin_' .  $id_coin);
    }

    public function returnUSDValue(string $id_coin, float $amount): float
    {
        // TODO: Implement returnUSDValue() method.
    }

}
