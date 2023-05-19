<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Coin;
use Illuminate\Http\JsonResponse;

class ApiCoinDataSource
{
    public function sellCoin($id_coin): ?Coin{
        $api = new apiClient();
        $response = $api->getCoinById($id_coin);
        if($response == "[]")
            return null;
        else {
            $jsonDes = json_decode($response,true);
            $nombre = $jsonDes[0]['name'];
            $simbolo = $jsonDes[0]['symbol'];
            $value_usd = $jsonDes[0]['price_usd'];

            return new Coin($id_coin, $simbolo, $nombre, $value_usd,1);
        }
    }
}
