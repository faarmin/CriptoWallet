<?php

namespace App\Infrastructure\Controllers;

use App\Application\Services\CreateWalletService;
use App\Application\Services\SellCoinService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SellCoinController
{
    private SellCoinService $service_sellCoin;
    public function __construct()
    {
        $this->service_sellCoin = new SellCoinService();
    }
    public function sell_coin(string $id_coin, string $id_wallet, int $cantidad): bool
    {
        return $this->service_sellCoin->execute($id_coin, $id_wallet,$cantidad);
    }
}
