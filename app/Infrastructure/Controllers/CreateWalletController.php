<?php

namespace App\Infrastructure\Controllers;

use App\Application\Services\CreateWalletService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class CreateWalletController
{
    private CreateWalletService $service_open_wallet;
    public function __construct()
    {
        $this->service_open_wallet = new CreateWalletService();
    }
    public function createWallet(string $id_user): JsonResponse
    {
        $respuesta = $this->service_open_wallet->execute($id_user);
        if ($respuesta instanceof JsonResponse) {
            return $respuesta;
        }
        return response()->json([
            'wallet_id' => 'wallet_' . $respuesta->getIdWallet(),
        ], Response::HTTP_OK);
    }
}
