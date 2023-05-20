<?php

namespace App\Application\Services;

use App\Application\DataSource\UserDataSource;
use App\Application\DataSource\WalletDataSource;
use App\Infrastructure\Persistence\ApiCoinDataSource;
use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Exception;
use Illuminate\Http\Response;

class SellCoinService
{
    private CacheWalletDataSource $cacheWalletDataSource;
    private ApiCoinDataSource $apiCoinDataSource;

    /**
     * @param CacheWalletDataSource $cacheWalletDataSource
     */
    public function __construct()
    {
        $this->cacheWalletDataSource = new CacheWalletDataSource();
        $this->apiCoinDataSource = new ApiCoinDataSource();
    }
    public function execute(string $id_coin, string $id_wallet): mixed
    {
        $wallet = $this->cacheWalletDataSource->walletExists($id_wallet);
        if (!$wallet) {
            throw new Exception("WalletNotFound");
        } else {
            $coin = $this->apiCoinDataSource->sellCoin($id_coin);
            if ($coin == null) {
                throw new Exception('CoinNotFound');
            }
            return $this->cacheWalletDataSource->sellCoin($coin, $id_wallet);
        }
    }
}
