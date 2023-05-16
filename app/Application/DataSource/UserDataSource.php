<?php

namespace App\Application\DataSource;

use App\Domain\Coin;
use App\Domain\User;

Interface UserDataSource
{
    /**
     * @return User[]
     */
    public function getAll(): ?array;

    public function userExists(String $id_user): bool;




}

