<?php

namespace App\Application\Services;
use App\Infrastructure\Persistence\ApiCoinDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use PHPUnit\Util\Exception;

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
    public function execute(string $id_coin, string $id_wallet, int $cantidad): mixed
    {
        $wallet = $this->cacheWalletDataSource->walletExists($id_wallet);
        if (!$wallet) {
            throw new Exception('WalletNotFound',1);
        } else {
            $coin = $this->apiCoinDataSource->sellCoin($id_coin,$cantidad);
            if ($coin == null) {
                throw new Exception('CoinNotFound',2);
            }
            return $this->cacheWalletDataSource->sellCoin($coin, $id_wallet,$cantidad);
        }
    }
}
