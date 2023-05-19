<?php

namespace App\Domain;

class User
{
    private int $user_id;

    private array $array_wallet;

    public function __construct(int $new_id)
    {
        $this->user_id = $new_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function setWallet(): void
    {
        $new_id = 0;
        $wallet = new Wallet($new_id);
        $this->array_wallet[] = $wallet;
    }
    public function getWallet(): ?array
    {
        return $this->array_wallet;
    }
}
