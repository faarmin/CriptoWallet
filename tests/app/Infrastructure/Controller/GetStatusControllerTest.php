<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\DataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetStatusControllerTest extends TestCase
{
    /**
     * @test
     */
    public function systemIsUpAndRunning()
    {
        $response = $this->get('/api/status');

        $response->assertExactJson(['status' => 'Ok', 'message' => 'Systems are up and running']);
    }
}
