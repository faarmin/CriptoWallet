<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GetWalletBalanceRequest
{
    private GetWalletBalanceController $controller;

    public function __construct()
    {
        $this->controller = new GetWalletBalanceController();
    }


    public function __invoke(Request $request): JsonResponse
    {
        $uri = explode("/", $request->getRequestUri());

        if (count($uri) === 5) {
            return $this->controller->getBalance($uri[3]);
        }
        return response()->json([
            'message' => 'bad request error',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
