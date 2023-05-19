<?php

namespace App\Application\DataSource;

use App\Domain\Coin;
use App\Domain\User;

Interface UserDataSource
{

    public function findUserById(String $id_user): bool;
    public function insertUser(string $id_user): User;
    public function cleanCache(): bool;




}

