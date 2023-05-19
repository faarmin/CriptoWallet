<?php

namespace App\Infrastructure\Controllers;
use App\Application\Services\GetWalletService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class CreateWalletController extends BaseController
{
    private GetWalletService $service_openwallet;
    public function __construct()
    {
        $this->service_openwallet= new GetWalletService();
    }
    public function __invoke(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'bad request error',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $userId = $request->input('user_id');
        $respuesta = $this->service_openwallet->execute($userId);
        if ($respuesta instanceof \Illuminate\Http\JsonResponse) {
            return $respuesta;
        }
        return response()->json([
            'wallet_id' => 'wallet_'.$respuesta->getIdUser(),
        ], Response::HTTP_OK);
    }
}
