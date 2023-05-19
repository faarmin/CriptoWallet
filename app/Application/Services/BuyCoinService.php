<?php

namespace App\Application\Services;

use App\Application\DataSource\CoinDataSource;
use App\Application\DataSource\WalletDataSource;
use App\Domain\Coin;
use App\Domain\Wallet;
use App\Infrastructure\Persistence\ApiCoinDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use PHPUnit\Util\Exception;

class BuyCoinService
{
    private WalletDataSource $walletDataSource;
    private CoinDataSource $coinDataSource;

    /**
     * @param WalletDataSource $userDataSource
     */
    public function __construct()
    {
        $this->coinDataSource = new ApiCoinDataSource();
        $this->walletDataSource = new CacheWalletDataSource();

    }
    public function execute(string $id_coin, string $id_wallet, float $amount): bool
    {
        //check wallet
        if($this->walletDataSource->walletExists($id_wallet))
        {
            //llamar a buycoin
            try{
                $coin = $this->coinDataSource->buyCoin($id_coin, $amount);
                //si no: buscar en wallet si existe esa coin
                $wallet = $this->walletDataSource->findWalletById($id_wallet);
                //si existe: actualizar amountUSD y el cambio (llamar funcion)
                if ($this->walletHasCoin($wallet, $coin))
                {
                    foreach ($wallet->getWalletContent() as $coin_in_wallet){
                        if ($coin_in_wallet->getCoinId() == $coin->getCoinId()){
                            $coin_in_wallet->setAmount($coin_in_wallet->getAmount()+$coin->getAmount());
                            $coin_in_wallet->setValueUsd($coin->getValueUsd());
                        }
                    }
                }
                else
                {
                    $array = $wallet->getWalletContent();
                    array_push($array,$coin);
                    $wallet->setCoin($array);
                }

            }catch (Exception $exception){
                return false;
            }
        }
        return false;
    }

    private function walletHasCoin(Wallet $wallet, Coin $coin): bool
    {
        foreach ($wallet->getWalletContent() as $coin_in_wallet){
            if ($coin_in_wallet->getCoinId() == $coin->getCoinId()){
                return true;
            }
        }
        return false;
    }
}
