<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\DataSource\UserDataSource;
use App\Domain\User;
use App\Domain\Wallet;
use Exception;
use Illuminate\Http\Response;
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
}
