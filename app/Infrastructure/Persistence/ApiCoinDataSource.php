<?php

namespace App\Infrastructure\Persistence;

use App\Application\DataSource\CoinDataSource;
use App\Domain\Coin;
use Illuminate\Support\Facades\Cache;

class ApiCoinDataSource implements CoinDataSource
{
    public function buyCoin(string $id_coin, float $amount): ?Coin
    {
        $class = new ApiClient();
        $coin_info_json =  $class->getCoinById($id_coin);
        $coin_info = json_decode($coin_info_json, true);

        return new
        Coin(
            "coin_" . $coin_info[0]['id'],
            $coin_info[0]['symbol'],
            $coin_info[0]['name'],
            $coin_info[0]['price_usd'],
            $amount
        );
    }
}
