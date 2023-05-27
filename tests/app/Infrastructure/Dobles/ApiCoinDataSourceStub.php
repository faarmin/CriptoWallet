<?php

namespace Tests\app\Infrastructure\Dobles;

use App\Application\DataSource\CoinDataSource;
use App\Domain\Coin;

class ApiCoinDataSourceStub implements CoinDataSource
{
    public function buyCoin(string $id_coin, float $amount): ?Coin
    {
        return new
        Coin(
            'coin_1',
            'LTC',
            'Litecoin',
            60,
            50
        );
    }
}
