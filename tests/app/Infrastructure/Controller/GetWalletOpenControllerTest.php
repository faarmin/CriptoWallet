<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\DataSource\UserDataSource;
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
    public function ErrorOpeningWithIdExisted()
    {
        $this->userdata
            ->expects('getAll')
            ->andReturn([new User(1, "email@email.com"), new User(2, "another_email@email.com")]);
        $response = $this->get('/api/wallet/open/1');
        $response->assertExactJson(['status' => 'Ok', 'message' => 'successful operation']);
    }
    /**
     * @test
     */
    public function ErrorOpeningWithIdNotExisted()
    {
        $this->userdata
            ->expects('getAll')
            ->andReturn([new User(1, "email@email.com"), new User(2, "another_email@email.com")]);
        $response = $this->get('/api/wallet/open/10');
        $response->assertNotFound();
        $response->assertExactJson(['message' => 'A user with the specified ID was not found.']);
    }
    /**
     * @test
     */
    public function ErrorOpeningWithIdButErrorRequest()
    {
        $this->userdata
            ->expects('getAll')
            ->andReturnNull();
        $response = $this->get('/api/wallet/open/10');
        $response->assertBadRequest();
        $response->assertExactJson(['message' => 'bad request']);
    }

}
