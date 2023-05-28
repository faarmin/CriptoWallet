<?php

namespace App\Infrastructure\Controllers;

use App\Application\Services\GetWalletBalanceService;
use App\Application\Services\GetWalletCoinsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use PHPUnit\Exception;

class GetWalletBalanceController
{
    private GetWalletBalanceService $service;

    public function __construct()
    {
        $this->service = new GetWalletBalanceService();
    }


    public function getBalance(string $int): JsonResponse
    {
        try {
            $response = $this->service->getBalance($int);
        } catch (Exception $ex) {
            return response()->json([
                'message' => 'A wallet with the specified ID was not found.',
            ], Response::HTTP_NOT_FOUND);
        }
        return $response;
    }
}
