<?php

namespace Tests\app\Infrastructure\Persistence;

use App\Domain\Wallet;
use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class WalletDataSourceTest extends TestCase
{
    /**
     * @test
     */
    public function insertWalletInCacheWith1()
    {
        Cache::shouldReceive('put')->once()->with('wallet_1', ['1',[]])->andReturn(new Wallet('1'));
        $class = new CacheWalletDataSource();
        $resultado = $class->insertWallet('1');
        $this->assertEquals(new Wallet('1'), $resultado);
    }

    /**
     * @test
     */
    public function checkIfWalletExistsWithKey1()
    {
        Cache::shouldReceive('has')->once()->with('1')->andReturn(true);
        $class = new CacheWalletDataSource();
        $response = $class->walletExists('1');
        $this->assertEquals(true, $response);
    }


    /**
     * @test
     */
    public function checkIfUserExistsToPutNewWalletAndFailed()
    {
        Cache::shouldReceive('has')->once()->with('user_100000')->andReturn(false);
        $response = $this->post('/api/wallet/open', ['user_id' => '100000']);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertExactJson([
            'message' => 'A user with the specified ID was not found.',
        ]);
    }
    /**
     * @test
     */
    public function checkIfUserExistsToPutNewWalletAndSuccess()
    {
        Cache::shouldReceive('has')->once()->with('user_0')->andReturn(true);
        Cache::shouldReceive('put')->once()->with('wallet_0', ['0',[]])->andReturn(new Wallet('0'));
        $response = $this->post('/api/wallet/open', ['user_id' => '0']);
        $response->assertExactJson([
            'wallet_id' => 'wallet_0',
        ]);
    }
    /**
     * @test
     */
    public function checkIfWalletExistsWithIdAndSuccess()
    {
        Cache::shouldReceive('has')->once()->with('wallet_0')->andReturn(true);
        $class = new CacheWalletDataSource();
        $response = $class->walletExists('wallet_0');
        $this->assertEquals(true, $response);
    }
    /**
     * @test
     */
    public function checkIfWalletExistsWithIdAndFail()
    {
        Cache::shouldReceive('has')->once()->with('wallet_10')->andReturn(false);
        $class = new CacheWalletDataSource();
        $response = $class->walletExists('wallet_10');
        $this->assertEquals(false, $response);
    }
}
