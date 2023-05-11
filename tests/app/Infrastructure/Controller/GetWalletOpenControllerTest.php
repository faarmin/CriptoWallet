<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetWalletOpenControllerTest extends TestCase
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
    public function systemIsUpAndRunning()
    {
        $this->userdata
            ->expects('getAll')
            ->andReturn([new User(1, "email@email.com"), new User(2, "another_email@email.com")]);
        $response = $this->get('/api/coin/buy/1');
        $response->assertExactJson(['status' => 'Ok', 'message' => 'successful operation']);
    }
    /**
     * @test
     */
    public function systemIsUpAndRunning2()
    {
        $this->userdata
            ->expects('getAll')
            ->andReturn([new User(1, "email@email.com"), new User(2, "another_email@email.com")]);
        $response = $this->get('/api/coin/buy/10');
        $response->assertExactJson(['message' => 'A user with the specified ID was not found.']);
    }

}
