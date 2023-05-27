<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GetWalletCoinsRequest
{
    private GetWalletCoinsController $controller;

    public function __construct()
    {
        $this->controller = new GetWalletCoinsController();
    }


    public function __invoke(Request $request): JsonResponse
    {
        $uri = explode("/", $request->getRequestUri());

        if (count($uri) === 4) {
            return $this->controller->getCoins($uri[3]);
        }
        return response()->json([
            'message' => 'bad request error',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
