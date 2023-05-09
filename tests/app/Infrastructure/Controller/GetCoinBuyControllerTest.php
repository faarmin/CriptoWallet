<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetCoinBuyControllerTest extends TestCase
{
    /**
     * @test
     */
    public function systemIsUpAndRunning()
    {
        $response = $this->get('/api/coin/buy');
        $response->assertExactJson(['status' => 'Ok', 'message' => 'Systems are up and running']);
    }
}
