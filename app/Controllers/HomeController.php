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
 * Time: 23:51
 */

namespace App\Controllers;

use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Intervention\Image\ImageManagerStatic as Image;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Cars;
use App\Services\PurifierService;
use Throwable;

use function compact;
use function dd;

/**
 * Class HomeController
 * @package src\Controllers
 */
class HomeController extends BaseController
{
    /**
     * @var string
     */
    public $path = '/';

    /**
     * @var array
     */
    public static $create_rules =
        [
            'Make' => 'required|string',
            'Name' => 'required|string',
            'Trim' => 'required|string',
            'Year' => 'required|string',
            'Body' => 'required|string',
            'Engine_Position' => 'required|string',
            'Engine_Type' => 'required|string',
            'Engine_Compression' => 'required|string',
            'Engine_Fuel' => 'required|string',
            'Image' => 'image|mimes:jpeg,bmp,png',
            'Country' => 'required|string',
            'Make_Display' => 'required|string',
            'Weight_KG' => 'required|string',
            'Transmission_Type' => 'required|string',
            'Price' => 'required|string',
        ];

    /**
     * @var array
     */
    public static $update_rules =
        [
            'Make' => 'required|string',
            'Name' => 'required|string',
            'Trim' => 'required|string',
            'Year' => 'required|string',
            'Body' => 'required|string',
            'Engine_Position' => 'required|string',
            'Engine_Type' => 'required|string',
            'Engine_Compression' => 'required|string',
            'Engine_Fuel' => 'required|string',
            'Image' => 'image|mimes:jpeg,bmp,png',
            'Country' => 'required|string',
            'Make_Display' => 'required|string',
            'Weight_KG' => 'required|string',
            'Transmission_Type' => 'required|string',
            'Price' => 'required|string',
        ];


    public function index(Request $request, Response $response, array $args = []): Response
    {
        $model = $this->showCarsSearchListing();
        $model_tags = $this->tagsFilter();

        // Query and paginate the results
        $results = Cars::query()->orderBy('id')->paginate(5);

        // CSRF token name and value
        $nameKey = $this->csrf->getTokenNameKey();
        $valueKey = $this->csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);

        return $this->render(
            $response,
            'office_user.index',
            compact(
                'model',
                'model_tags',
                'nameKey',
                'valueKey',
                'name',
                'value',
            )
        );
    }

    /**
     * @param $request
     * @param $response
     *
     * @return mixed
     * @throws Throwable
     */
    public function DoCreateCar($request, $response)
    {
        try {
            #Files Instance
            $uploadedFilesInstance = $request->getUploadedFiles();
            // handle single input with single file upload from Instance
            $uploadedFile = $uploadedFilesInstance['Image'];

            preg_match_all(
                '/([a-zA-Z0-9_-]+).([a-z]+)/m',
                (string) $_FILES['Image']['name'],
                $matches,
                PREG_SET_ORDER,
                0
            );
            $file_name = PurifierService::clean($matches[0][1] ?? isset($matches[0][1]));
            $file_extension = PurifierService::clean($matches[0][2] ?? isset($matches[0][1]));
            $file_name_generate = str_slug(
                    $file_name . '-' . Carbon::now()->format('Y.m.d H:i:s'),
                    '-'
                ) . '.' . $file_extension;


            $do_create_car = new Cars();
            $do_create_car->Make = PurifierService::clean($request->getParam('Make'));
            $do_create_car->Name = PurifierService::clean($request->getParam('Name'));
            $do_create_car->Trim = PurifierService::clean($request->getParam('Trim'));
            $do_create_car->Year = PurifierService::clean($request->getParam('Year'));
            $do_create_car->Body = PurifierService::clean($request->getParam('Body'));
            $do_create_car->Engine_Position = PurifierService::clean($request->getParam('Engine_Position'));
            $do_create_car->Engine_Type = PurifierService::clean($request->getParam('Engine_Type'));
            $do_create_car->Engine_Compression = PurifierService::clean($request->getParam('Engine_Compression'));
            $do_create_car->Engine_Fuel = PurifierService::clean($request->getParam('Engine_Fuel'));
            $do_create_car->Country = PurifierService::clean($request->getParam('Country'));

            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                try {
                    #Resize and Store Image
                    Image::make($_FILES['Image']['tmp_name'])->resize(300, 200)->save($file_name_generate);
                    $do_create_car->Image = (string) $this->path . $file_name_generate;
                } catch (Throwable $exception) {
                    die('Wrong File Extension');
                }
            }

            $do_create_car->Make_Display = PurifierService::clean($request->getParam('Make_Display'));
            $do_create_car->Weight_KG = PurifierService::clean($request->getParam('Weight_KG'));
            $do_create_car->Transmission_Type = PurifierService::clean($request->getParam('Transmission_Type'));
            $do_create_car->Tags = PurifierService::clean($request->getParam('Tags'));
            $do_create_car->Price = PurifierService::clean($request->getParam('Price'));
            $do_create_car->saveOrFail();
        } catch (ModelNotFoundException $exception) {
            $_SESSION["errors"] =
                [
                    PurifierService::clean('Oop Something Went Wrong!')
                ];
        }
    }


    /**
     * @param $id
     *
     * @return mixed
     */
    public function ShowUpdateCar($id)
    {
        try {
            $model_car_find = Cars::findOrFail((integer) $id);
        } catch (ModelNotFoundException $exception) {
            die('Not Found Record');
        }

        return $model_car_find;
    }

    /**
     * @param $request
     */
    public function DoUpdateCar($request)
    {
        try {
            $find_car = Cars::findOrFail((integer) $request->getParam('id'));

            $find_car->update(
                [
                    'Make' => PurifierService::clean($request->getParam('Make')),
                    'Name' => PurifierService::clean($request->getParam('Name')),
                    'Trim' => PurifierService::clean($request->getParam('Trim')),
                    'Year' => PurifierService::clean($request->getParam('Year')),
                    'Body' => PurifierService::clean($request->getParam('Body')),
                    'Engine_Position' => PurifierService::clean($request->getParam('Engine_Position')),
                    'Engine_Type' => PurifierService::clean($request->getParam('Engine_Type')),
                    'Engine_Compression' => PurifierService::clean($request->getParam('Engine_Compression')),
                    'Engine_Fuel' => PurifierService::clean($request->getParam('Engine_Fuel')),
                    'Country' => PurifierService::clean($request->getParam('Country')),
                    'Make_Display' => PurifierService::clean($request->getParam('Make_Display')),
                    'Weight_KG' => PurifierService::clean($request->getParam('Weight_KG')),
                    'Transmission_Type' => PurifierService::clean($request->getParam('Transmission_Type')),
                    'Tags' => PurifierService::clean($request->getParam('Tags')),
                    'Price' => PurifierService::clean($request->getParam('Price')),
                ]
            );


            #Files Instance
            $uploadedFilesInstance = $request->getUploadedFiles();
            // handle single input with single file upload from Instance
            $uploadedFile = $uploadedFilesInstance['Image'];

            preg_match_all(
                '/([a-zA-Z0-9_-]+).([a-z]+)/m',
                (string) $_FILES['Image']['name'],
                $matches,
                PREG_SET_ORDER,
                0
            );
            $file_name = PurifierService::clean($matches[0][1] ?? isset($matches[0][1]));
            $file_extension = PurifierService::clean($matches[0][2] ?? isset($matches[0][1]));
            $file_name_generate = str_slug(
                    $file_name . '-' . Carbon::now()->format('Y.m.d H:i:s'),
                    '-'
                ) . '.' . $file_extension;

            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                try {
                    #Resize and Store Image
                    Image::make($_FILES['Image']['tmp_name'])->resize(800, 533)->save($file_name_generate);

                    $find_car->update(
                        [
                            'Image' => (string) $this->path . $file_name_generate
                        ]
                    );
                } catch (Throwable $exception) {
                    die('Wrong File Extension');
                }
            }
        } catch (ModelNotFoundException $exception) {
            die('Not Found Record');
        }
    }

    /**
     * @param $id
     */
    public function DoDestroyCar($id)
    {
        try {
            $find_car = Cars::findOrFail((integer) $id);
            $find_car->delete();
        } catch (ModelNotFoundException $exception) {
            die('Not Found Record');
        }
    }

    /**
     * @return mixed
     */
    public function ShowCarsListing()
    {
        return Cars::OrderBy('id', 'desc')->paginate(10)->setPath('/office/dashboard/cars');
    }

    /**
     * @return mixed
     */
    public function showCarsSearchListing()
    {
        if (! empty($_SERVER['QUERY_STRING'])) {
            return Cars::Filter(array_filter($_GET))->OrderBy('id', 'desc')->paginate(8);
        } else {
            return Cars::Filter(array_filter($_GET))->OrderBy('id', 'desc')->paginate(8);
        }
    }

    public function tagsFilter()
    {
        return Cars::query()->select('Tags', 'id')->distinct('Tags')->groupBy('Tags')->get();
    }
}