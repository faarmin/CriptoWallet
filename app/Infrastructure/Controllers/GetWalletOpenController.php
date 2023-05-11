<?php

namespace App\Infrastructure\Controllers;
use App\Application\UserDataSource\UserDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetWalletOpenController extends BaseController
{
    private UserDataSource $userDataSource;

    /**
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }
    public function __invoke(int $id): JsonResponse
    {
        $users= $this->userDataSource->getAll();
        //recorrer los usuarios y ver si existe alguno con el id del parametro
        foreach ($users as $user ){
            if($user->getId() == $id){
                return response()->json([
                    'status' => 'Ok',
                    'message' => 'successful operation',
                ], Response::HTTP_OK);
            }
        }
        return response()->json([
            'message' => 'A user with the specified ID was not found.',
        ], Response::HTTP_NOT_FOUND);
    }
}
