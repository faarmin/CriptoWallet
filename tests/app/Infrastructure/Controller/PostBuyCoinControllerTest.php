<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\DataSource\UserDataSource;
use App\Domain\Coin;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;
/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class PostBuyCoinControllerTest extends TestCase
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
    public function errorBuyingCoinWithIdNotExisted()
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
    public function errorBuyingCoinWithIdExisted()
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
    public function errorBuyingCoinWithWrongId()
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
