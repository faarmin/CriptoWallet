<?php

namespace Tests\app\Infrastructure\Persistence;

use App\Domain\User;
use App\Domain\Wallet;
use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class UserDataSourceTest extends TestCase
{
    /**
     * @test
     */
    public function checkIfUserCanBeInsertedInCache()
    {
        Cache::shouldReceive('put')->once()->with('user_0',['0',null])->andReturn(new User('0'));
        $class = new CacheUserDataSource();
        $response = $class->insertUser('0');
        $this->assertEquals(new User('0'),$response);
    }
    /**
     * @test
     */
    public function checkIfUserExistsInCacheAndSuccess()
    {
        Cache::shouldReceive('has')->once()->with('user_0')->andReturn(true);
        $class = new CacheUserDataSource();
        $response = $class->findUserById('0');
        $this->assertEquals(true,$response);
    }
    /**
     * @test
     */
    public function checkIfUserExistsInCacheAndFail()
    {
        Cache::shouldReceive('has')->once()->with('-1')->andReturn(true);
        $class = new CacheUserDataSource();
        $response = $class->findUserById('-1');
        $this->assertEquals(true,$response);
    }
}
