<?php

namespace App\Application\DataSource;

interface WalletCoinDataSource
{

    public function getCoinsByWalletId(string $id_wallet): ?Wallet;

}

