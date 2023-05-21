<?php

namespace Tests\app\Infrastructure\Controller;

use App\Infrastructure\Controllers\PostBuyCoinController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Tests\app\Infrastructure\Dobles\ApiCoinDataSourceStub;
use Tests\TestCase;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class PostBuyCoinControllerTest extends TestCase
{
    /**
     * @test
     */
    public function coinBuyBadRequest()
    {
        $response = $this->post('/api/coin/buy', ['wallet_id' => '1','coin_id' => 1,'amount' => 50]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertExactJson(['message' => 'bad request error']);
    }
    /**
     * @test
     */
    public function errorBuyingCoinWithNonExistentId()
    {
        Cache::shouldReceive('has')->once()->with('wallet_1')->andReturn(true);

        $response = $this->post('/api/coin/buy', ['wallet_id' => '1','coin_id' => '-1','amount' => 50]);

        $response->assertNotFound();
        $response->assertExactJson(['message' => 'A coin with the specified ID was not found.']);
    }
    /**
     * @test
     */
    public function errorBuyingCoinWithNonExistentWallet()
    {
        Cache::shouldReceive('has')->once()->with('wallet_1')->andReturn(false);

        $response = $this->post('/api/coin/buy', ['wallet_id' => '1','coin_id' => '1','amount' => 50]);

        $response->assertNotFound();
        $response->assertExactJson(['message' => 'A wallet with the specified ID was not found.']);
    }
    /**
     * @test
     */
    public function buyingCoinSuccess()
    {
        $controller = new PostBuyCoinController(new ApiCoinDataSourceStub());
        Cache::shouldReceive('has')->once()->with('wallet_1')->andReturn(true);
        Cache::shouldReceive('get')->once()->with('wallet_1')->andReturn(['1',[]]);
        Cache::shouldReceive('put')->once()
            ->with('wallet_1', ['1',[['coin_1','Litecoin','LTC',60,50]]])->andReturn(true);

        $response = $controller->buyCoin('1', '1', 50);

        $this->assertEquals('{"status":"Ok","message":"successful operation"}', $response->getContent());
    }
}
