<?php

namespace App\Application\Services;

use App\Infrastructure\Persistence\ApiCoinDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use PHPUnit\Util\Exception;

class SellCoinService
{
    private CacheWalletDataSource $cacheWalletDS;
    private ApiCoinDataSource $apiCoinDataSource;

    /**
     *@param CacheWalletDataSource $cacheWalletDS
     */
    public function __construct()
    {
        $this->cacheWalletDS = new CacheWalletDataSource();
        $this->apiCoinDataSource = new ApiCoinDataSource();
    }
    public function execute(string $id_coin, string $id_wallet, int $cantidad): mixed
    {
        $wallet = $this->cacheWalletDS->walletExists($id_wallet);
        if (!$wallet) {
            throw new Exception('WalletNotFound', 1);
        }

        $coin = $this->apiCoinDataSource->sellCoin($id_coin, $cantidad);
        if ($coin == null) {
            throw new Exception('CoinNotFound', 2);
        }
        return $this->cacheWalletDS->sellCoin($coin, $id_wallet, $cantidad);
    }
}
