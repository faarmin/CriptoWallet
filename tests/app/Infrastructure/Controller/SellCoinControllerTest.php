<?php

namespace Tests\app\Infrastructure\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class SellCoinControllerTest extends TestCase
{
    /**
     * @test
     */
    public function errorTryingToSellACoinWithIdInt()
    {
        $response = $this->post('/api/coin/sell',['coin_id' => '1','wallet_id' => '5']);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertExactJson([
            'message' => 'bad request error',
        ]);
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
        $response = $this->post('/api/coin/sell',['coin_id' => '1','wallet_id' => '1','amount_usd'=>1]);
        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        $response->assertExactJson([
            'error' => 'CoinNotFound',
        ]);
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
        $response = $this->post('/api/coin/sell',['coin_id' => '1','wallet_id' => '1','amount_usd'=>1]);
        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        $response->assertExactJson([
            'error' => 'WalletNotFound',
        ]);
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
            ->andReturn(['1',[['10', 'ETC', 'VIAGRA', '90', 1],['3', 'ETC', 'VIAGRA', '90', 1]]]);
        $this->expectExceptionMessage("CoinIsNotInWallet");
        $response = $this->post('/api/coin/sell',['coin_id' => '1','wallet_id' => '1','amount_usd'=>1]);
        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        $response->assertExactJson([
            'error' => 'CoinIsNotInWallet',
        ]);
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
            ->andReturn(['1',[['10', 'ETC', 'VIAGRA', '90', 1],['1', 'ETC', 'VIAGRA', '90', 4]]]);
        Cache::shouldReceive('put')
            ->once()
            ->with('wallet_1',['1',[['10', 'ETC', 'VIAGRA', '90', 1],['1', 'ETC', 'VIAGRA', '90', 3]]])
            ->andReturn(true);
        $response = $this->post('/api/coin/sell',['coin_id' => '1','wallet_id' => '1','amount_usd'=>1]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            'mensaje' => 'Success selling coin',
        ]);
    }
}
