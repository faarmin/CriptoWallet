<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\DataSource\UserDataSource;
use App\Domain\User;
use App\Infrastructure\Persistence\CacheUserDataSource;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetWalletOpenControllerTest extends TestCase
{
    /**
     * @test
     */
    public function errorOpeningWithIdString()
    {
        $response = $this->post('/api/wallet/open',['wallet_id' => 1]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertExactJson([
            'message' => 'bad request error',
        ]);
    }


    /**
     * @test
     */
    public function CheckIfRequestFunctionIsReadyAndCallTheController()
    {
        //insertar user
        $class = new CacheUserDataSource();
        $class->insertUser('1');

        $response = $this->post('/api/wallet/open',['user_id' => '1']);

        $response->assertExactJson([
            'wallet_id' => 'wallet_1',
        ]);
        $response->assertStatus(Response::HTTP_OK);

    }
}
