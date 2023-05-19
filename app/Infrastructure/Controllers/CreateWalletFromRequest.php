<?php

namespace App\Infrastructure\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class CreateWalletFromRequest extends BaseController
{
    private CreateWalletController $wallet_controller;
    public function __construct()
    {
        $this->wallet_controller= new CreateWalletController();
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
        return $this->wallet_controller->create_wallet($userId);
    }
}
