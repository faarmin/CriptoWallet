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

class CrearUserController extends BaseController
{
    private CacheUserDataSource $cacheuser;
    public function __construct()
    {
        $this->cacheuser= new CacheUserDataSource();
    }
    public function __invoke(string $id): JsonResponse
    {
        $this->cacheuser->insertUser($id);
        return response()->json([
            'user_id' => $id,
        ], Response::HTTP_OK);
    }
}
