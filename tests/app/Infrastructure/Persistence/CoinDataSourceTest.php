<?php

namespace Tests\app\Infrastructure\Persistence;

use App\Domain\Coin;
use App\Domain\User;
use App\Infrastructure\Persistence\ApiCoinDataSource;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CoinDataSourceTest extends TestCase
{
    /**
     * @test
     */
    public function buyCoinSuccess()
    {
        $class = new ApiCoinDataSource();
        $coin = $class->buyCoin("5", 60);

        $this->assertEquals($coin->getCoinId(), 'coin_5');
    }
}
