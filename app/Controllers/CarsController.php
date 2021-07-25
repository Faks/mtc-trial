<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Cars;
use App\Services\PurifierService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Throwable;

use function compact;
use function end;
use function explode;

use const UPLOAD_ERR_OK;

class CarsController extends BaseController
{
    public function index(Request $request, Response $response, array $args = []): Response
    {
        if ($this->isAuthenticated($request)) {
            return $this->locationLogin($response);
        }

        return $this->render(
            $response,
            'office.cars.index',
            [
                'model' => Cars::query()
                    ->orderBy('id', 'desc')
                    ->paginate(5)
            ]
        );
    }

    public function create(Request $request, Response $response, array $args = []): Response
    {
        if ($this->isAuthenticated($request)) {
            return $this->locationLogin($response);
        }

        // CSRF token name and value
        $nameKey = $this->csrf->getTokenNameKey();
        $valueKey = $this->csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);
        $model = new Cars();

        return $this->render(
            $response,
            'office.cars.create',
            compact(
                'nameKey',
                'valueKey',
                'name',
                'value',
                'model'
            )
        );
    }

    public function store(Request $request, Response $response, array $args = []): Response
    {
        if ($this->isAuthenticated($request)) {
            return $this->locationLogin($response);
        }

        // CSRF token name and value
        $nameKey = $this->csrf->getTokenNameKey();
        $valueKey = $this->csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);
        $data = $request->getParsedBody();

        $validator = $this->validator->make(
            $data,
            [
                'Make' => [
                    'required',
                    'string'
                ],
                'Name' => [
                    'required',
                    'string'
                ],
                'Trim' => [
                    'required',
                    'string'
                ],
                'Year' => [
                    'required',
                    'string'
                ],
                'Body' => [
                    'required',
                    'string'
                ],
                'Engine_Position' => [
                    'required',
                    'string'
                ],
                'Engine_Type' => [
                    'required',
                    'string'
                ],
                'Engine_Compression' => [
                    'required',
                    'string'
                ],
                'Engine_Fuel' => [
                    'required',
                    'string'
                ],
                'Country' => [
                    'required',
                    'string'
                ],
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $model = new Cars();

            return $this->render(
                $response,
                'office.cars.create',
                compact(
                    'errors',
                    'nameKey',
                    'valueKey',
                    'name',
                    'value',
                    'model'
                )
            );
        }

        try {
            #Files Instance
            $uploadedFilesInstance = $request->getUploadedFiles();
            // handle single input with single file upload from Instance
            $uploadedFile = $uploadedFilesInstance['Image'];

            $responseFileExplode = explode('.', $uploadedFile->getClientFilename());
            $fileName = PurifierService::clean($responseFileExplode[0]);
            $fileExtension = PurifierService::clean(end($responseFileExplode));
            $fileNameWithDate = $fileName . '-'
                . Carbon::now()->format('Y.m.d H:i:s')
                . '-' . '.' . $fileExtension;

            $storeCar = new Cars();
            $storeCar->Make = PurifierService::clean($data['Make']);
            $storeCar->Name = PurifierService::clean($data['Name']);
            $storeCar->Trim = PurifierService::clean($data['Trim']);
            $storeCar->Year = PurifierService::clean($data['Year']);
            $storeCar->Body = PurifierService::clean($data['Body']);
            $storeCar->Engine_Position = PurifierService::clean($data['Engine_Position']);
            $storeCar->Engine_Type = PurifierService::clean($data['Engine_Type']);
            $storeCar->Engine_Compression = PurifierService::clean($data['Engine_Compression']);
            $storeCar->Engine_Fuel = PurifierService::clean($data['Engine_Fuel']);
            $storeCar->Country = PurifierService::clean($data['Country']);

            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                try {
                    #Resize and Store Image
                    Image::make($_FILES['Image']['tmp_name'])
                        ->resize(300, 200)
                        ->save($fileNameWithDate);

                    $storeCar->Image = "/$fileNameWithDate";
                } catch (Throwable $exception) {
                    $errors = [
                        $exception->getMessage()
                    ];
                    $model = new Cars();

                    return $this->render(
                        $response,
                        'office.cars.create',
                        compact(
                            'errors',
                            'nameKey',
                            'valueKey',
                            'name',
                            'value',
                            'model'
                        )
                    );
                }
            }

            $storeCar->Make_Display = PurifierService::clean($data['Make_Display']);
            $storeCar->Weight_KG = PurifierService::clean($data['Weight_KG']);
            $storeCar->Transmission_Type = PurifierService::clean($data['Weight_KG']);
            $storeCar->Tags = PurifierService::clean($data['Tags']);
            $storeCar->Price = PurifierService::clean($data['Price']);
            $storeCar->saveOrFail();
        } catch (ModelNotFoundException $exception) {
            $errors = [
                $exception->getMessage()
            ];
            $model = new Cars();

            return $this->render(
                $response,
                'office.cars.create',
                compact(
                    'errors',
                    'nameKey',
                    'valueKey',
                    'name',
                    'value',
                    'model'
                )
            );
        } catch (Throwable $e) {
            $errors = [
                $e->getMessage()
            ];
            $model = new Cars();

            return $this->render(
                $response,
                'office.cars.create',
                compact(
                    'errors',
                    'nameKey',
                    'valueKey',
                    'name',
                    'value',
                    'model'
                )
            );
        }

        return $response->withHeader(
            'Location',
            '/office/dashboard/cars'
        )
            ->withStatus(302);
    }

    public function edit(Request $request, Response $response, array $args = []): Response
    {
        if ($this->isAuthenticated($request)) {
            return $this->locationLogin($response);
        }

        // CSRF token name and value
        $nameKey = $this->csrf->getTokenNameKey();
        $valueKey = $this->csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);

        try {
            $model = Cars::query()->findOrFail($args['id']);
        } catch (ModelNotFoundException $exception) {
            return $response->withHeader(
                'Location',
                '/office/dashboard/cars'
            )
                ->withStatus(302);
        }

        return $this->render(
            $response,
            'office.cars.update',
            compact(
                'model',
                'nameKey',
                'valueKey',
                'name',
                'value',
                'args',
            )
        );
    }

    public function update(Request $request, Response $response, array $args = []): Response
    {
        if ($this->isAuthenticated($request)) {
            return $this->locationLogin($response);
        }

        // CSRF token name and value
        $nameKey = $this->csrf->getTokenNameKey();
        $valueKey = $this->csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);
        $data = $request->getParsedBody();

        $validator = $this->validator->make(
            $data,
            [
                'Make' => [
                    'required',
                    'string'
                ],
                'Name' => [
                    'required',
                    'string'
                ],
                'Trim' => [
                    'required',
                    'string'
                ],
                'Year' => [
                    'required',
                    'string'
                ],
                'Body' => [
                    'required',
                    'string'
                ],
                'Engine_Position' => [
                    'required',
                    'string'
                ],
                'Engine_Type' => [
                    'required',
                    'string'
                ],
                'Engine_Compression' => [
                    'required',
                    'string'
                ],
                'Engine_Fuel' => [
                    'required',
                    'string'
                ],
                'Country' => [
                    'required',
                    'string'
                ],
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $model = new Cars();

            return $this->render(
                $response,
                'office.cars.update',
                compact(
                    'errors',
                    'nameKey',
                    'valueKey',
                    'name',
                    'value',
                    'model'
                )
            );
        }

        try {
            $updateCar = Cars::query()->findOrFail($args['id']);
            $updateCar->update(
                [
                    'Make' => PurifierService::clean($data['Make']),
                    'Name' => PurifierService::clean($data['Name']),
                    'Trim' => PurifierService::clean($data['Trim']),
                    'Year' => PurifierService::clean($data['Year']),
                    'Body' => PurifierService::clean($data['Body']),
                    'Engine_Position' => PurifierService::clean($data['Engine_Position']),
                    'Engine_Type' => PurifierService::clean($data['Engine_Type']),
                    'Engine_Compression' => PurifierService::clean($data['Engine_Compression']),
                    'Engine_Fuel' => PurifierService::clean($data['Engine_Fuel']),
                    'Country' => PurifierService::clean($data['Country']),
                    'Make_Display' => PurifierService::clean($data['Make_Display']),
                    'Weight_KG' => PurifierService::clean($data['Weight_KG']),
                    'Transmission_Type' => PurifierService::clean($data['Transmission_Type']),
                    'Tags' => PurifierService::clean($data['Tags']),
                    'Price' => PurifierService::clean($data['Price']),
                ]
            );

            #Files Instance
            $uploadedFilesInstance = $request->getUploadedFiles();
            // handle single input with single file upload from Instance
            $uploadedFile = $uploadedFilesInstance['Image'];

            $responseFileExplode = explode('.', $uploadedFile->getClientFilename());
            $fileName = PurifierService::clean($responseFileExplode[0]);
            $fileExtension = PurifierService::clean(end($responseFileExplode));
            $fileNameWithDate = $fileName . '-'
                . Carbon::now()->format('Y.m.d H:i:s')
                . '-' . '.' . $fileExtension;

            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                try {
                    #Resize and Store Image
                    Image::make($_FILES['Image']['tmp_name'])
                        ->resize(800, 533)
                        ->save($fileNameWithDate);

                    $updateCar->update(
                        [
                            'Image' => "/$fileNameWithDate"
                        ]
                    );
                } catch (Throwable $exception) {
                    $errors = [
                        $exception->getMessage()
                    ];
                    $model = new Cars();

                    return $this->render(
                        $response,
                        'office.cars.update',
                        compact(
                            'errors',
                            'nameKey',
                            'valueKey',
                            'name',
                            'value',
                            'model'
                        )
                    );
                }
            }
        } catch (ModelNotFoundException $exception) {
            $errors = [
                $exception->getMessage()
            ];
            $model = new Cars();

            return $this->render(
                $response,
                'office.cars.update',
                compact(
                    'errors',
                    'nameKey',
                    'valueKey',
                    'name',
                    'value',
                    'model'
                )
            );
        }

        return $response->withHeader(
            'Location',
            '/office/dashboard/cars'
        )
            ->withStatus(302);
    }

    public function destroy(Request $request, Response $response, array $args = []): Response
    {
        if ($this->isAuthenticated($request)) {
            return $this->locationLogin($response);
        }

        try {
            $destroyCar = Cars::query()
                ->findOrFail($args['id']);
            if ($destroyCar->Image !== null && File::exists(__DIR__ . "/../../public/$destroyCar->Image")) {
                File::delete(__DIR__ . "/../../public/$destroyCar->Image");
            }
            $destroyCar->delete();
        } catch (ModelNotFoundException $exception) {
            return $response->withHeader(
                'Location',
                '/office/dashboard/cars'
            )
                ->withStatus(302);
        }

        return $response->withHeader(
            'Location',
            '/office/dashboard/cars'
        )
            ->withStatus(302);
    }
}
