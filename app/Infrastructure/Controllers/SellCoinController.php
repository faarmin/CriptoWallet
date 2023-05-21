<?php

namespace App\Infrastructure\Controllers;

use App\Application\Services\CreateWalletService;
use App\Application\Services\SellCoinService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use PHPUnit\Util\Exception;

class SellCoinController
{
    private SellCoinService $service_sellCoin;
    public function __construct()
    {
        $this->service_sellCoin = new SellCoinService();
    }
    public function sell_coin(string $id_coin, string $id_wallet, int $cantidad): mixed
    {
        try{
            return $this->service_sellCoin->execute($id_coin, $id_wallet,$cantidad);
        }catch (Exception $ex){
            if($ex->getCode()==1){
                return response()->json([
                    'error' => 'WalletNotFound',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }else if($ex->getCode()==2){
                return response()->json([
                    'error' => 'CoinNotFound',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }else if($ex->getCode()==3){
                return response()->json([
                    'error' => 'CoinIsNotInWallet',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }else{
                return response()->json([
                    'error' => 'NotCoinsEnought',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }
}
