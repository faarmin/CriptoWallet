<?php

namespace Tests\app\Infrastructure\Controller;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class GetWalletBalanceControllerTest extends TestCase
{
    /**
     * @test
     */
    public function errorWalletIdNotFound()
    {
        $response = $this->get('/api/wallet/1/balance');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertExactJson([
            'message' => 'A wallet with the specified ID was not found.',
        ]);
    }

    /**
     * @test
     */
    public function getWalletCoinSuccessfully()
    {
        Cache::shouldReceive('has')
            ->once()
            ->with('wallet_1')
            ->andReturn(true);

        Cache::shouldReceive('get')
            ->once()
            ->with('wallet_1')
            ->andReturn(['1',[['10', 'ETC', 'VIAGRA', '90', 1],['3', 'ETC', 'VIAGRA', '90', 1]]]);

        $response = $this->get('/api/wallet/1/balance');

        $response->assertExactJson(["balance_usd" => 180]);
    }

    /**
     * @test
     */
    public function getWalletCoinIsEmpty()
    {
        Cache::shouldReceive('has')
            ->once()
            ->with('wallet_1')
            ->andReturn(true);

        Cache::shouldReceive('get')
            ->once()
            ->with('wallet_1')
            ->andReturn(['1',[]]);

        $response = $this->get('/api/wallet/1/balance');

        $response->assertExactJson(["balance_usd" => 0]);
    }
}
