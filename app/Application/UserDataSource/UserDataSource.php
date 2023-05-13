<?php

namespace App\Application\UserDataSource;

use App\Domain\Coin;
use App\Domain\User;

Interface UserDataSource
{
    public function findByEmail(string $email): ?User;
    public function findCoinById(int $id): ?Coin;

    /**
     * @return User[]
     */
    public function getAll(): ?array;


}
