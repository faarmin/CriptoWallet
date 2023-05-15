<?php

namespace App\Application\DataSource;

use App\Domain\Coin;
use App\Domain\User;
use App\Domain\Wallet;

interface UserDataSource
{
    public function findByEmail(string $email): ?User;
<<<<<<< HEAD:app/Application/WalletDataSource/UserDataSource.php
=======
    public function findCoinById(int $id_coin): ?Coin;
    public function findWalletById(int $wallet): ?Wallet;
>>>>>>> 7ee0347db462a49bc43a88e9271a30078abd8c0b:app/Application/UserDataSource/UserDataSource.php
    /**
     * @return User[]
     */
    public function getAll(): ?array;
}
