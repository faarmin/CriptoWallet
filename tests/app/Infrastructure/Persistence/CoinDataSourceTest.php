<?php

namespace Tests\app\Infrastructure\Persistence;

use App\Domain\Coin;
use App\Domain\User;
use App\Infrastructure\Persistence\ApiCoinDataSource;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Util\Exception;
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

    /**
     * @test
     */
    public function buyCoinErrorNotFound()
    {
        try {
            $class = new ApiCoinDataSource();
            $class->buyCoin("-1", 60);

            $this->fail("Se esperaba una excepción");
        } catch (Exception $ex) {
            $this->assertEquals("El id de la coin no es correcto", $ex->getMessage());
        }
    }
}
