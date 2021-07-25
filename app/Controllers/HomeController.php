<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Cars;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function array_filter;
use function compact;

class HomeController extends BaseController
{
    public function index(Request $request, Response $response, array $args = []): Response
    {
        $model = Cars::query()->Filter(array_filter($_GET))->OrderBy('id', 'desc')->paginate(8);
        $model_tags = Cars::query()->select('Tags', 'id')->distinct('Tags')->groupBy('Tags')->get();

        // CSRF token name and value
        $nameKey = $this->csrf->getTokenNameKey();
        $valueKey = $this->csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);

        return $this->render(
            $response,
            'home.index',
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
}
