<?php

namespace App\Application\Services;

use App\Application\DataSource\WalletDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Illuminate\Http\JsonResponse;
use PHPUnit\Util\Exception;

class GetWalletCoinsService
{
    private WalletDataSource $walletDataSource;

    public function __construct()
    {
        $this->walletDataSource = new CacheWalletDataSource();
    }

    public function getCoins(string $wallet_id): JsonResponse
    {
        if ($this->walletDataSource->walletExists($wallet_id)) {
            $coins = $this->walletDataSource->getWalletCoins($wallet_id);
            $final_array = [];
            foreach ($coins as $coin) {
                $data = [
                    "coin_id" => $coin[0],
                    "name" => $coin[1],
                    "symbol" => $coin[2],
                    "amount" => $coin[4],
                    "value_usd" => $coin[3]
                ];
                $final_array[] = $data;
            }
            return response()->json($final_array);
        }
        throw new Exception("Wallet ID not found", 50);
    }
}
