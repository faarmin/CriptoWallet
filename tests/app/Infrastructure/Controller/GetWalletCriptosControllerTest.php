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
    private UserDataSource $userdata;
    /**
     * @setUp
     */
    protected function setUp(): void
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
    public function successfulOperationCompleted()
    {
        $this->userdata
            ->expects('findWalletById')
            ->with(6666)
            ->andReturn(new Wallet(6666));

        $response = $this->get('/api/wallet/6666');
        $response->assertExactJson(['status' => 'Ok', 'message' => 'successful operation']);
    }

    /**
     * @test
     */
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

/*
    public function errorNotValidId()
    {
        $this->userdata
            ->expects('findWalletById')
            ->andReturnNull();

        $response = $this->get('/api/wallet/');
        $response->assertBadRequest();
        $response->assertExactJson(['message' => 'bad request error']);
    }*/
}
