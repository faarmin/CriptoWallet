<?php

namespace App\Infrastructure\Persistence;

use App\Application\DataSource\UserDataSource;
use App\Domain\Coin;
use App\Domain\User;
use App\Domain\Wallet;
use PHP_CodeSniffer\Util\Cache;

class FileUserDataSource implements UserDataSource
{

    public function __invoke( )
    {
        Schema::create('user', function($table)
        {
            $table->string('user_id')->unique();
            $table->integer('expiration');
        });
    }
    public function userExists(String $id_user): bool
    {
        return \Illuminate\Support\Facades\Cache::has($id_user);
    }


