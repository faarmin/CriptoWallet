<?php

namespace App\Infrastructure\Controllers;
use App\Application\DataSource\UserDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class PostBuyCoinController extends BaseController
{
    private UserDataSource $userDataSource;

    /**
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }
    public function __invoke(int $id_wallet, int $id_coin): JsonResponse
    {
        $coin= $this->userDataSource->findCoinById($id_coin);
        if($coin == null){
            return response()->json([
                'message' => 'A coin with the specified ID was not found.',
            ], Response::HTTP_NOT_FOUND);
        }else if($coin->getId() == -1){
            return response()->json([
                'message' => 'bad request error',
            ], Response::HTTP_BAD_REQUEST);
        }
        return response()->json([
            'status' => 'Ok',
            'message' => 'successful operation',
        ], Response::HTTP_OK);
    }
}
