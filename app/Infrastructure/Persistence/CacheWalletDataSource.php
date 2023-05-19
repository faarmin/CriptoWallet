<?php

namespace App\Infrastructure\Persistence;
use App\Application\DataSource\WalletDataSource;
use App\Domain\Coin;
use App\Domain\Wallet;
use Illuminate\Support\Facades\Cache;
use Exception;
class CacheWalletDataSource implements WalletDataSource
{
    public function insertWallet(string $id_wallet): Wallet
    {
        $wallet = new Wallet($id_wallet);
        Cache::put("wallet_".$id_wallet,[$id_wallet,$wallet->getWalletContent()]);
        return $wallet;
    }
    public function findWalletById(string $id_wallet): bool
    {
        return Cache::has("wallet_".$id_wallet);
    }

    public function sellCoin(Coin $coin, String $id_wallet): bool
    {
        $datosCoin = [$coin->getCoinId(),$coin->getName(),$coin->getSymbol(),$coin->getValueUsd(),$coin->getAmount()];

        $datosWallet = Cache::get("wallet_".$id_wallet);
        $arrayCoins = $datosWallet[1];
        if (empty($arrayCoins))
            throw new Exception("CoinIsNotInWallet");
        else {
            foreach ($arrayCoins as $indice => &$coin) {
                if ($coin[0] == $datosCoin[0]) {
                    $coin[4] = $coin[4] - 1;
                    if ($coin[4] == 0) {
                        unset($arrayCoins[$indice]);
                    }
                }
            }
            return Cache::put("wallet_".$id_wallet,[$id_wallet,$arrayCoins]);
        }
    }
}
