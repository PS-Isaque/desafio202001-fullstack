<?php
/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */

namespace App\v1\Config;


use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use function OpenApi\scan;

/**
 * Class Routes
 * @package App\v1\Config
 * @OA\Schema(schema="InternalServerError", type="object", @OA\Property(property="message", description="Internal Server Error", type="string", example="Internal Server Error."))
 */
class Routes
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Routes constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->container = $this->app->getContainer();
    }

    /**
     * Method responsible to manage all app routes
     */
    public function make()
    {
        $this->app->get('/doc', function (Request $request, Response $response) {
            $request;
           $openapi = scan(__DIR__ . "/../../");
            return $response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
                ->withJson(json_decode($openapi->toJson()));
        });

        $this->app->group('/api/v1', function () {
            $this->group('/address', function () {
                $this->map(['GET'], '/all', 'App\v1\Controller\AddressController:all');
                $this->map(['GET'], '/{id}', 'App\v1\Controller\AddressController:show');
                $this->map(['POST'], '/create', 'App\v1\Controller\AddressController:create');
                $this->map(['PATCH'], '/update/{id}', 'App\v1\Controller\AddressController:update');
                $this->map(['DELETE'], '/{id}', 'App\v1\Controller\AddressController:delete');
            });
        });
    }
}
