<?php

namespace App\Infrastructure\Controllers;
use App\Application\DataSource\UserDataSource;
use App\Application\Services\BuyCoinService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use PHPUnit\Util\Exception;

class PostBuyCoinController extends BaseController
{
    private BuyCoinService $buyCoinService;

    /**
     * @param UserDataSource $userDataSource
     */
    public function __construct(BuyCoinService $buyCoinService)
    {
        $this->buyCoinService = $buyCoinService;
    }
    public function __invoke(string $id_wallet, string $id_coin, float $amount): JsonResponse
    {
        try{
            $this->buyCoinService->execute($id_coin, $id_wallet, $amount);
        }catch (Exception $ex) {
            if ($ex->getCode() == 45){
                return response()->json([
                    'message' => 'A coin with the specified ID was not found.',
                ], Response::HTTP_NOT_FOUND);
            }
            else if ($ex->getCode() == 50){
                return response()->json([

                'message' => 'A wallet with the specified ID was not found.',
            ], Response::HTTP_NOT_FOUND);
        }}
        return response()->json([
            'status' => 'Ok',
            'message' => 'successful operation',
        ], Response::HTTP_OK);
    }
}
