<?php

namespace App\Infrastructure\Controllers;

use App\Application\Services\SellCoinService;
use Illuminate\Http\Response;
use PHPUnit\Util\Exception;

class SellCoinController
{
    private SellCoinService $service_sellCoin;
    public function __construct()
    {
        $this->service_sellCoin = new SellCoinService();
    }
    public function sellCoin(string $id_coin, string $id_wallet, int $cantidad): mixed
    {
        try {
            return $this->service_sellCoin->execute($id_coin, $id_wallet, $cantidad);
        } catch (Exception $ex) {
            if ($ex->getCode() == 1) {
                return response()->json([
                    'error' => 'WalletNotFound',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            } elseif ($ex->getCode() == 2) {
                return response()->json([
                    'error' => 'CoinNotFound',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            } elseif ($ex->getCode() == 3) {
                return response()->json([
                    'error' => 'CoinIsNotInWallet',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return response()->json([
                'error' => 'NotCoinsEnought',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
