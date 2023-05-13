<?php

namespace App\Application\UserDataSource;

use App\Domain\Coin;
use App\Domain\User;
use App\Domain\Wallet;

interface UserDataSource
{
    public function findByEmail(string $email): ?User;
    public function findCoinById(int $id_coin): ?Coin;
    public function findWalletById(int $wallet): ?Wallet;
    /**
     * @return User[]
     */
    public function getAll(): ?array;
}
