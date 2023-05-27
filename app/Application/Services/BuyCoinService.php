<?php

namespace App\Application\Services;

use App\Application\DataSource\CoinDataSource;
use App\Application\DataSource\WalletDataSource;
use App\Domain\Coin;
use App\Domain\Wallet;
use App\Infrastructure\Persistence\ApiCoinDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use PHPUnit\Util\Exception;

use function PHPUnit\Framework\throwException;

class BuyCoinService
{
    private WalletDataSource $walletDataSource;
    private CoinDataSource $coinDataSource;


    public function __construct($apiCoinDataSource = null)
    {
        $this->coinDataSource = new ApiCoinDataSource();

        if ($apiCoinDataSource !== null) {
            $this->coinDataSource = $apiCoinDataSource;
        }

        $this->walletDataSource = new CacheWalletDataSource();
    }
    public function execute(string $id_wallet, string $id_coin, float $amount_usd): bool
    {
        if ($this->walletDataSource->walletExists($id_wallet)) {
            try {
                $coin = $this->coinDataSource->buyCoin($id_coin, $amount_usd);
            } catch (Exception $exception) {
                throw new Exception("El id de la coin no es correcto", 45);
            }
            $coin_as_array =
                [$coin->getCoinId(),$coin->getName(),$coin->getSymbol(),$coin->getValueUsd(),$coin->getAmount()];
            $wallet = $this->walletDataSource->findWalletById($id_wallet);
            $in_wallet = false;

            if (!empty($wallet->getWalletContent())) {
                foreach ($wallet->getWalletContent() as &$coin_in_wallet) {
                    if ($coin_in_wallet[0] == $coin_as_array[0]) {
                        $in_wallet = true;

                        $coin_in_wallet[4] += $coin_as_array[4];
                        $coin_in_wallet[3] = $coin_as_array[3];
                    }
                }
            }
            if (!$in_wallet) {
                $array = $wallet->getWalletContent();
                array_push($array, $coin_as_array);
                $wallet->setCoin($array);
            }
            $this->walletDataSource->insertNewObjectWallet($wallet);
            return true;
        }
        throw new Exception("Wallet ID not found", 50);
    }
}
