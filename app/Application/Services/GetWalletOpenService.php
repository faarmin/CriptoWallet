<?php

namespace App\Application\Services;

use App\Application\DataSource\WalletDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GetWalletOpenService
{
    private WalletDataSource $userDataSource;

    /**
     * @param WalletDataSource $userDataSource
     */
    public function __construct(WalletDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }
    public function __invoke(int $id_wallet): JsonResponse
    {
        return response()->json([
            'message' => 'A user with the specified ID was not found.',
        ], Response::HTTP_NOT_FOUND);
    }
}
