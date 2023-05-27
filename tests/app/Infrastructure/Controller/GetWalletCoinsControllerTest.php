<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\DataSource\UserDataSource;
use App\Domain\User;
use App\Domain\Wallet;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Mockery;
use Tests\TestCase;

class GetWalletCoinsControllerTest extends TestCase
{
    /**
     * @test
     */
    public function errorWalletIdNotFound()
    {
        $response = $this->get('/api/wallet/1');

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

        $response = $this->get('/api/wallet/1');

        $response->assertExactJson([[
            "coin_id" => "10",
            "name" => "ETC",
            "symbol" => "VIAGRA",
            "amount" => 1,
            "value_usd" => "90",
        ],
            ["coin_id" => "3",
            "name" => "ETC",
            "symbol" => "VIAGRA",
            "amount" => 1,
            "value_usd" => "90",]]);
    }
}
