<?php

namespace App\Application\Services;

use App\Application\DataSource\UserDataSource;
use App\Application\DataSource\WalletDataSource;
use App\Infrastructure\Persistence\FileUserDataSource;
use App\Infrastructure\Persistence\FileWalletDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GetWalletOpenService
{
    private WalletDataSource $walletDataSource;
    private UserDataSource $userDataSource;

    /**
     * @param WalletDataSource $userDataSource
     */
    public function __construct()
    {
        $this->walletDataSource = new FileWalletDataSource();
        $this->userDataSource = new FileUserDataSource();
    }
    public function execute(string $id_user): JsonResponse
    {
        $existe_user=$this->userDataSource->userExists($id_user);
        if($existe_user==null){
            return response()->json([
                'message' => 'A user with the specified ID was not found.',
            ], Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            'status' => 'Ok',
            'message' => 'successful operation',
        ], Response::HTTP_OK);
    }
}
