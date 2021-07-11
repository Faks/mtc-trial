<?php
/**
 * Created by PhpStorm.
 * User: Faks
 * GitHub: https://github.com/Faks
 *******************************************
 * Company Name: Solum DeSignum
 * Company Website: http://solum-designum.com
 * Company GitHub: https://github.com/SolumDeSignum
 ********************************************************
 * Date: 2018.10.04.
 * Time: 21:38
 */

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\Cars;
use App\Services\PurifierService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function array_merge;
use function implode;
use function number_format;
use function random_int;
use function range;
use function setlocale;
use function shuffle;
use function substr;

use const LC_MONETARY;

class CarsApiController extends BaseController
{
    public static string $API_URL = "https://www.carqueryapi.com/api/0.3/?cmd=getTrims&year=2018";

    /**
     * @return bool|string
     */
    public function init(): bool|string
    {
        $url = self::$API_URL;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    /**
     * @throws \JsonException
     */
    public function store(Request $request, Response $response, array $args = []): Response
    {
        foreach ((array)json_decode($this->init(), true, 512, JSON_THROW_ON_ERROR) as $item => $key) {
            foreach ((array)$key as $car_item => $car_key) {
                try {
                    Cars::query()->updateOrCreate(
                        [
                            'Make' => PurifierService::clean($car_key['model_make_id']),
                            'Name' => PurifierService::clean($car_key['model_name']),
                            'Trim' => PurifierService::clean($car_key['model_trim']),
                            'Year' => PurifierService::clean((integer)$car_key['model_year']),
                            'Body' => PurifierService::clean($car_key['model_body']),
                            'Engine_Position' => PurifierService::clean($car_key['model_engine_position']),
                            'Engine_Type' => PurifierService::clean($car_key['model_engine_type']),
                            'Engine_Compression' => PurifierService::clean($car_key['model_engine_compression']),
                            'Engine_Fuel' => PurifierService::clean($car_key['model_engine_fuel']),
                            'Country' => PurifierService::clean($car_key['make_country']),
                            'Make_Display' => PurifierService::clean($car_key['model_make_display']),
                            'Weight_KG' => PurifierService::clean($car_key['model_weight_kg']),
                            'Transmission_Type' => PurifierService::clean($car_key['model_transmission_type']),
                            'Price' => PurifierService::clean($this->formatted()),
                            'Tags' => PurifierService::clean($this->randNames()),
                            'Is_API' => 'yes'
                        ]
                    );
                } catch (ModelNotFoundException $exception) {
                    die('api save failed');
                }
            }
        }

        return $response->withHeader('Location', '/office/dashboard/cars')
            ->withStatus(302);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function formatted(): string
    {
        setlocale(LC_MONETARY, 'de_DE');

        return number_format($this->rand(), '2', '.', ',');
    }

    /**
     * @return float
     * @throws \Exception
     */
    public function rand(): float
    {
        return (float)random_int(6000, 55000);
    }


    public function randNames(): string
    {
        $word = array_merge(range('a', 'z'), range('A', 'Z'));
        shuffle($word);

        return substr(implode($word), 0, 6);
    }
}