<?php

namespace Tests\app\Infrastructure\Controller;

use App\Domain\Coin;
use App\Domain\User;
use App\Infrastructure\Controllers\SellCoinController;
use App\Infrastructure\Persistence\apiClient;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class SellCoinControllerTest extends TestCase
{
    private SellCoinController $sellCoinController;
    protected function setUp(): void
    {
        $this->sellCoinController = new SellCoinController();
    }

    /**
     * @test
     */
    public function coinWithGivenidDoesNotExist()
    {
        Cache::shouldReceive('has')
            ->once()
            ->with('wallet_1')
            ->andReturn(true);

        $this->expectExceptionMessage("CoinNotFound");

        $this->sellCoinController->sell_coin("-1", "1");
    }

    /**
     * @test
     */
    public function walletWithGivenidDoesNotExist()
    {
        Cache::shouldReceive('has')
            ->once()
            ->with('wallet_1')
            ->andReturn(false);

        $this->expectExceptionMessage("WalletNotFound");

        $this->sellCoinController->sell_coin("1", "1");
    }

    /**
     * @test
     */
    public function walletHasNotTheGivenCoinToSell()
    {
        Cache::shouldReceive('has')
            ->once()
            ->with('wallet_1')
            ->andReturn(true);

        Cache::shouldReceive('get')
            ->once()
            ->with('wallet_1')
            ->andReturn(['1',[]]);

        $this->expectExceptionMessage("CoinIsNotInWallet");

        $this->sellCoinController->sell_coin("1", "1");
    }

    /**
     * @test
     */
    public function walletWithExistingIdAndCoinWithExistingIdSold()
    {
        Cache::shouldReceive('has')
            ->once()
            ->with('wallet_1')
            ->andReturn(true);

        Cache::shouldReceive('get')
            ->once()
            ->with('wallet_1')
            ->andReturn(['1',[['1','Bitcoin','BTC','2000',2]]]);

        Cache::shouldReceive('put')
            ->once()
            ->with('wallet_1', ['1',[['1','Bitcoin','BTC','2000',1]]])
            ->andReturn(true);

        $return = $this->sellCoinController->sell_coin("1", "1");

        $this->assertTrue($return);
    }
}
