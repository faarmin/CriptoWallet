<?php

namespace App\Infrastructure\Persistence;

use App\Application\DataSource\CoinDataSource;
use App\Domain\Coin;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Util\Exception;

use function PHPUnit\Framework\isEmpty;

class ApiCoinDataSource implements CoinDataSource
{
    public function buyCoin(string $id_coin, float $amount_usd): ?Coin
    {
        $class = new ApiClient();
        $coin_info_json =  $class->getCoinById($id_coin);
        $coin_info = json_decode($coin_info_json, true);

        if (empty($coin_info)) {
            throw new Exception("El id de la coin no es correcto", 45);
        }
        $amount_coins = $amount_usd/$coin_info[0]['price_usd'];
        return new
        Coin(
            "coin_" . $coin_info[0]['id'],
            $coin_info[0]['symbol'],
            $coin_info[0]['name'],
            $coin_info[0]['price_usd'],
            $amount_coins
        );
    }

    public function sellCoin($id_coin, $cantidad): ?Coin
    {
        $api = new apiClient();
        $response = $api->getCoinById($id_coin);
        if ($response == "[]") {
            return null;
        }
        $jsonDes = json_decode($response, true);
        $nombre = $jsonDes[0]['name'];
        $simbolo = $jsonDes[0]['symbol'];
        $value_usd = $jsonDes[0]['price_usd'];

        return new Coin($id_coin, $simbolo, $nombre, $value_usd, $cantidad);
    }
}
