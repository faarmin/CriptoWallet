<?php

namespace App\Infrastructure\Controllers;

use App\Application\DataSource\CoinDataSource;
use App\Application\DataSource\UserDataSource;
use App\Application\Services\BuyCoinService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use PHPUnit\Util\Exception;

class PostBuyCoinController extends BaseController
{
    private BuyCoinService $buyCoinService;


    public function __construct($apiCoinDataSource = null)
    {
        $this->buyCoinService = new BuyCoinService();

        if ($apiCoinDataSource !== null) {
            $this->buyCoinService = new BuyCoinService($apiCoinDataSource);
        }
    }
    public function buyCoin(string $id_wallet, string $id_coin, float $amount): JsonResponse
    {
        try {
            $this->buyCoinService->execute($id_wallet, $id_coin, $amount);
        } catch (Exception $ex) {
            if ($ex->getCode() == 45) {
                return response()->json([
                    'message' => 'A coin with the specified ID was not found.',
                ], Response::HTTP_NOT_FOUND);
            } elseif ($ex->getCode() == 50) {
                return response()->json([

                'message' => 'A wallet with the specified ID was not found.',
                ], Response::HTTP_NOT_FOUND);
            }
        }
        return response()->json([
            'status' => 'Ok',
            'message' => 'successful operation',
        ], Response::HTTP_OK);
    }
}
