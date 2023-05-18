<?php

namespace App\Infrastructure\Persistence;

use App\Application\DataSource\UserDataSource;
use App\Domain\Coin;
use App\Domain\User;
use App\Domain\Wallet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;

class CacheUserDataSource implements UserDataSource
{
    public function findUserById(string $id_user): bool
    {
        return Cache::has('user_'.$id_user);
    }
    public function insertUser(string $id_user): User
    {
        $user = new User($id_user);
        $wallet=null;
        Cache::put("user_".$id_user,[$id_user,$wallet]);
        return $user;
    }
    public function cleanCache(): bool{
        Cache::flush();
        return true;
    }
}

