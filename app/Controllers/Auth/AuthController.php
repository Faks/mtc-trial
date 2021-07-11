<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Users;
use App\Services\PurifierService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function compact;

class AuthController extends BaseController
{
    public function login(Request $request, Response $response, array $args = []): Response
    {
        // CSRF token name and value
        $nameKey = $this->csrf->getTokenNameKey();
        $valueKey = $this->csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);
        $errors = false;

        return $this->render(
            $response,
            'login',
            compact(
                'errors',
                'nameKey',
                'valueKey',
                'name',
                'value'
            )
        );
    }

    public function store(Request $request, Response $response, array $args = []): Response
    {
        $params = $request->getParsedBody();

        $store = new Users();
        $store->username = PurifierService::clean($params['username']);
        $store->password = \hash('sha512', PurifierService::clean($params['password']));
        $store->save();

        return $response->withHeader('Location', '/login')->withStatus(302);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     */
    public function show(Request $request, Response $response, array $args = []): Response
    {
        $session = $request->getAttribute('session');

        // CSRF token name and value
        $nameKey = $this->csrf->getTokenNameKey();
        $valueKey = $this->csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);

        $validator = $this->validator
            ->make(
                $request->getParsedBody(),
                [
                    'username' => [
                        'required',
                        'string',
                        'alpha_dash'
                    ],
                    'password' => [
                        'required',
                        'string',
                        'min:6'
                    ]
                ]
            );

        if ($validator->fails()) {
            $session['authenticated'] = false;
            $session['user'] = null;
            $errors = $validator->errors();

            return $this->render(
                $response,
                'login',
                compact(
                    'errors',
                    'nameKey',
                    'valueKey',
                    'name',
                    'value'
                )
            );
        }

        $authUser = Users::query()
            ->where(
                [
                    'username' => PurifierService::clean($request->getParsedBody()['username']),
                    'password' => \hash('sha512', PurifierService::clean($request->getParsedBody()['password']))
                ]
            )
            ->first();

        #Session Initiate
        $session['authenticated'] = true;
        $session['user'] = $authUser->getAttributes();

        #Removing Error Text
        unset($session['errors']);

        return $response->withHeader('Location', '/office/dashboard')->withStatus(302);
    }

    /**
     * Session Cleanup
     */
    public function logout(Request $request, Response $response, array $args = []): Response
    {
        $session = $request->getAttribute('session');
        unset($session);
        session_unset();
        session_destroy();

        return $response->withHeader('Location', '/login')->withStatus(302);
    }
}