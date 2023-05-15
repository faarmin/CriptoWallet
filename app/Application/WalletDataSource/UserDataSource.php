<?php

namespace App\Application\DataSource;

use App\Domain\Coin;
use App\Domain\User;

Interface UserDataSource
{
    public function findByEmail(string $email): ?User;
    /**
     * @return User[]
     */
    public function getAll(): ?array;


}
