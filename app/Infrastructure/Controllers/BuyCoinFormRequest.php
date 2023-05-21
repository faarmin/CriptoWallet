<?php

namespace App\Infrastructure\Controllers;

use App\Application\DataSource\CoinDataSource;
use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */

class BuyCoinFormRequest extends BaseController
{
    private PostBuyCoinController $buy_coin_controller;

    public function __construct($apiCoinDataSource = null)
    {
        $this->buy_coin_controller = new PostBuyCoinController();

        if ($apiCoinDataSource !== null) {
            $this->buy_coin_controller = new PostBuyCoinController($apiCoinDataSource);
        }
    }
    public function __invoke(Request $request): mixed
    {
        $validator = Validator::make($request->all(), [
            'wallet_id' => 'required|string',
            'coin_id' => 'required|string',
            'amount' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'bad request error',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $coinId = $request->input('coin_id');
        $walletId = $request->input('wallet_id');
        $amount = $request->input('amount');
        return $this->buy_coin_controller->buyCoin($walletId, $coinId, $amount);
    }
}
