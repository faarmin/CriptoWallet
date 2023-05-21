<?php

namespace Tests\app\Infrastructure\Persistence;

use App\Domain\Coin;
use App\Domain\User;
use App\Infrastructure\Persistence\CacheCoinDataSource;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CoinDataSourceTest extends TestCase
{
    /**
     * @test
     */
    public function insertCoinSuccess()
    {
        Cache::shouldReceive('put')->once()->with('coin_0',['coin_0','A','A',50,90])->andReturn(new Coin('coin_0','A','A',50,90));

        $class = new CacheCoinDataSource();
        $response = $class->insertCoin('0','A','A',50,90);

        $this->assertEquals(new Coin('coin_0','A','A',50,90), $response);
    }

    /**
     * @test
     */
    public function findCoinByIdSuccess()
    {
        $class = new CacheCoinDataSource();
        $class->insertCoin('0','A','A',50,60);

        Cache::shouldReceive('get')->once()->with('coin_0')->andReturn(new Coin('coin_0','A','A',50,60));

        $response = $class->findCoinById('0');

        $this->assertEquals(new Coin('coin_0','A','A',50,60), $response);
    }

    /**
     * @test
     */
    public function findCoinByIdError()
    {
        Cache::shouldReceive('get')->once()->with('coin_110')->andReturn(null);

        $class = new CacheCoinDataSource();
        $response = $class->findCoinById('110');

        $this->assertEquals(null, $response);
    }

    /**
     * @test
     */
    public function CoinExistsSuccess()
    {
        $class = new CacheCoinDataSource();
        $class->insertCoin('1','A','A',50,60);

        Cache::shouldReceive('has')->once()->with('coin_1')->andReturn(true);

        $response = $class->coinExists('1');
        $this->assertEquals(true, $response);
    }

    /**
     * @test
     */
    public function CoinExistsFail()
    {
        $class = new CacheCoinDataSource();

        Cache::shouldReceive('has')->once()->with('coin_1')->andReturn(true);

        $response = $class->coinExists('1');
        $this->assertEquals(true, $response);
    }
}
