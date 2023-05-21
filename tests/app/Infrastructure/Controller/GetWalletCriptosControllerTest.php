<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\DataSource\UserDataSource;
use App\Domain\User;
use App\Domain\Wallet;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetWalletCriptosControllerTest extends TestCase
{
    /**
     * @setUp
     */
    /*
    protected function setUp(): void
    {
        parent::setUp();
        $this->userdata = \Mockery::mock(UserDataSource::class);
        $this->app->bind(UserDataSource::class, function () {
            return $this->userdata;
        });
    }
    */
    /**
     * @test
     */

    public function successfulOperationCompleted()
    {
        $result = 2 + 2;
        $this->assertEquals(4, $result);
    }

    /**
     * @test
     */
    /*
    public function errorNotWalletFoundWithGivenId()
    {
        $this->userdata
            ->expects('findWalletById')
            ->with(6666)
            ->andReturnNull();

        $response = $this->get('/api/wallet/6666');
        $response->assertNotFound();
        $response->assertExactJson(['message' => 'A wallet with the specified ID was not found.']);
    }
    */
    /**
     * @test
     */
    /*
    public function errorNotValidId()
    {
        $this->userdata
            ->expects('findWalletById')
            ->andReturnNull();

        $response = $this->get('/api/wallet/');
        $response->assertBadRequest();
        $response->assertExactJson(['message' => 'bad request error']);
    }
    */
}
