<?php

namespace App\Infrastructure\Controllers;
use App\Application\DataSource\UserDataSource;
use App\Application\DataSource\WalletDataSource;
use App\Application\Services\GetWalletOpenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetWalletOpenController extends BaseController
{
    private UserDataSource $userDataSource;
    private GetWalletOpenService $service_openwallet;

    /**
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
        $this->service_openwallet= new GetWalletOpenService();
    }
    public function __invoke(int $id_user): JsonResponse
    {
        return $this->service_openwallet->execute($id_user);
    }
}
