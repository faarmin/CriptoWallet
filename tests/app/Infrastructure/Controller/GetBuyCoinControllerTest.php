<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\Coin;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetBuyCoinControllerTest extends TestCase
{
    private UserDataSource $userdata;
    /**
     * @setUp
     */
    protected function setUp():void
    {
        parent::setUp();
        $this->userdata = \Mockery::mock(UserDataSource::class);
        $this->app->bind(UserDataSource::class, function () {
            return $this->userdata;
        });
    }
    /**
     * @test
     */
    public function ErrorBuyingCoinWithIdNotExisted()
    {
        $this->userdata
            ->expects('findCoinById')
            ->with(1)
            ->andReturnNull();
        $response = $this->get('/api/coin/buy/1/1');
        $response->assertNotFound();
        $response->assertExactJson(['message' => 'A coin with the specified ID was not found.']);
    }
    /**
     * @test
     */
    public function ErrorBuyingCoinWithIdExisted()
    {
        $this->userdata
            ->expects('findCoinById')
            ->with(1)
            ->andReturn(new Coin(1));
        $response = $this->get('/api/coin/buy/1/1');
        $response->assertExactJson(['status' => 'Ok', 'message' => 'successful operation']);
    }
    /**
     * @test
     */
    public function ErrorBuyingCoinWithWrongId()
    {
        $this->userdata
            ->expects('findCoinById')
            ->with(1)
            ->andReturn(new Coin(-1));
        $response = $this->get('/api/coin/buy/1/1');
        $response->assertBadRequest();
        $response->assertExactJson(['message' => 'bad request error']);
    }
}
