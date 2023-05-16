<?php

namespace Tests\app\Infrastructure\Persistence;

use App\Domain\Wallet;
use App\Infrastructure\Persistence\FileWalletDataSource;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class WalletDataSourceTest extends TestCase
{
    /**
     * @test
     */
    public function insertWalletInCache()
    {
        Cache::shouldReceive('put')->once()->with('1',0);
        $class = new FileWalletDataSource;

        $class->insertWallet('1');
    }

    /**
     * @test
     */
    public function checkIfWalletExists()
    {
        Cache::shouldReceive('has')->once()->with('1');
        $class = new FileWalletDataSource;

        $response = $class->walletExists('1');
    }
}
