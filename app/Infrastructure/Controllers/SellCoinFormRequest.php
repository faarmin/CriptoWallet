<?php

namespace App\Infrastructure\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class SellCoinFormRequest extends BaseController
{
    private SellCoinController $sell_coin_controller;
    public function __construct()
    {
        $this->sell_coin_controller = new SellCoinController();
    }
    public function __invoke(Request $request): mixed
    {
        $validator = Validator::make($request->all(), [
            'coin_id' => 'required|string',
            'wallet_id' => 'required|string',
            'amount_usd' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'bad request error',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $coinId = $request->input('coin_id');
        $walletId = $request->input('wallet_id');
        $cantidad = $request->input('amount_usd');
        $respuesta= $this->sell_coin_controller->sell_coin($coinId, $walletId,$cantidad);
        if ($respuesta instanceof \Illuminate\Http\JsonResponse) {
            return $respuesta;
        }else{
            return response()->json([
                'mensaje' => 'Success selling coin',
            ], Response::HTTP_OK);
        }
    }
}
