<?php

namespace App\Infrastructure\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'bad request error',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $coinId = $request->input('coin_id');
        $walletId = $request->input('wallet_id');
        return $this->sell_coin_controller->sell_coin($coinId, $walletId);
    }
}
