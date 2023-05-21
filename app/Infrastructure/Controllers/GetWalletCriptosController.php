<?php

namespace App\Infrastructure\Controllers;

use App\Application\DataSource\UserDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GetWalletCriptosController
{
    private UserDataSource $userDataSource;

    /**
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }
    public function __invoke(int $id_wallet = null): JsonResponse
    {
        $wallet = $this->userDataSource->findWalletById($id_wallet);
        if ($id_wallet === null) {
            return response()->json([
                'message' => 'bad request error',
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($wallet == null) {
            return response()->json([
                'message' => 'A wallet with the specified ID was not found.',
            ], Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            'status' => 'Ok',
            'message' => 'successful operation',
        ], Response::HTTP_OK);
    }
}
