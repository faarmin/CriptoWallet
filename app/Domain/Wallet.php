<?php

namespace App\Domain;

class Wallet
{
    private int $id_user;
    public function __construct(int $id)
    {
        $this->id_user = $id;
    }
    public function getIdUser(): int
    {
        return $this->id_user;
    }
}
