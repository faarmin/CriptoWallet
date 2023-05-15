<?php

namespace App\Infrastructure\Persistence;

use App\Application\DataSource\UserDataSource;
use App\Domain\Coin;
use App\Domain\User;
use App\Domain\Wallet;

class FileUserDataSource implements UserDataSource
{
    public function findByEmail(string $email): ?User
    {
        return new User(1, "email@email.com");
    }
    public function getAll(): ?array
    {
        return [new User(1, "email@email.com"), new User(2, "another_email@email.com")];
    }
<<<<<<< HEAD
=======
    public function findCoinById(int $id_coin): ?Coin
    {
        return new Coin(3);
    }
    public function findWalletById(int $wallet): ?Wallet
    {
        if ($wallet === null) {
            return null;
        }
        return new Wallet(6666);
    }
>>>>>>> 7ee0347db462a49bc43a88e9271a30078abd8c0b
}
