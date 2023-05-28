<?php

namespace App\Application\Services;

use App\Application\DataSource\WalletDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Illuminate\Http\JsonResponse;
use PHPUnit\Util\Exception;

class GetWalletBalanceService
{
    private WalletDataSource $walletDataSource;

    public function __construct()
    {
        $this->walletDataSource = new CacheWalletDataSource();
    }

    public function getBalance(string $wallet_id): JsonResponse
    {
        if ($this->walletDataSource->walletExists($wallet_id)) {
            $coins = $this->walletDataSource->getWalletCoins($wallet_id);
            $balance = 0;
            foreach ($coins as $coin) {
                $balance  += $coin[3] * $coin[4];
            }
            $data = ["balance_usd" => $balance];
            return response()->json($data);
        }
        throw new Exception("Wallet ID not found", 50);
    }
}
