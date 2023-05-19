<?php

namespace App\Infrastructure\Controllers;
use App\Application\DataSource\UserDataSource;
use App\Application\DataSource\WalletDataSource;
use App\Application\Services\CreateWalletService;
use App\Infrastructure\Persistence\CacheUserDataSource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class CreateUserController extends BaseController
{
    private CacheUserDataSource $cacheUser;
    public function __construct()
    {
        $this->cacheUser= new CacheUserDataSource();
    }
    public function __invoke(string $id_user): JsonResponse
    {
        $this->cacheuser->insertUser($id_user);
        return response()->json([
            'user_id' => $id_user,
        ], Response::HTTP_OK);
    }
}
