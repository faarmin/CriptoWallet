<?php

namespace App\Application\Services;

use App\Application\DataSource\UserDataSource;
use App\Application\DataSource\WalletDataSource;
use App\Domain\Wallet;
use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CreateWalletService
{
    private WalletDataSource $walletDataSource;
    private UserDataSource $userDataSource;

    /**
     * @param WalletDataSource $userDataSource
     */
    public function __construct()
    {
        $this->walletDataSource = new CacheWalletDataSource();
        $this->userDataSource = new CacheUserDataSource();
    }
    public function execute(string $id_user): mixed
    {
        $user = $this->userDataSource->findUserById($id_user);
        if (!$user) {
            throw new Exception("UserNotFound");
        }
        return $this->walletDataSource->insertWallet($id_user);
    }
}
