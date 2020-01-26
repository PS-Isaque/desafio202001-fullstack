<?php

namespace App\v1\Config;

use App\v1\Controller\AddressController;
use App\v1\Request\AddressRequest;
use App\v1\Util\Validation\ValidationFactory;
use Illuminate\Database\Capsule\Manager;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;
use Slim\Views\PhpRenderer;

class Dependencies
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
     * Dependencies constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->container = $this->app->getContainer();
    }

    /**
     * Make all application dependencies
     * @return ContainerInterface
     */
    public function make() : ContainerInterface
    {
        $this->setErrorHandler();
        $this->setRenderer();
        $this->setEloquent();
        $this->setRequests();
        $this->setControllers();
        $this->setValidator();

        return $this->container;
    }

    /**
     * Set renderer dependencies
     */
    private function setRenderer()
    {
        $this->container['renderer'] = function (ContainerInterface $c) {
            $settings = $c->get('settings')['renderer'];
            return new PhpRenderer($settings['template_path']);
        };
    }

    /**
     * Set db to container
     */
    private function setEloquent()
    {
        $capsule = new Manager();
        $capsule->addConnection($this->container['settings']['db']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $this->container['db'] = function () use ($capsule) {
            return $capsule;
        };
    }

    /**
     * Set error handler dependencies
     */
    private function setErrorHandler()
    {
        $this->container['errorHandler'] = function (ContainerInterface $c) {
            return function (Request $request, Response $response, \Exception $e) use ($c) {
                $reflectedClass = new \ReflectionClass(StatusCode::class);
                $statusCode = (in_array($e->getCode(), $reflectedClass->getConstants())) ? $e->getCode() : StatusCode::HTTP_INTERNAL_SERVER_ERROR;

                $dataResponse['message'] = $e->getMessage();

                return $response->withJson($dataResponse)->withStatus($statusCode);
            };
        };
    }


    /**
     * Set requests dependencies
     */
    private function setRequests()
    {
        $this->container[AddressRequest::class] = function (ContainerInterface $container) {
            return new AddressRequest($container);
        };
    }

    /**
     * Set controllers dependencies
     */
    private function setControllers()
    {

        $this->container[AddressController::class] = function () {
            $controller = new AddressController($this->container);
            $controller->setRequestManager($this->container[AddressRequest::class]);

            return $controller;
        };
    }

    /**
     * Set validator dependencies
     */
    private function setValidator()
    {
        $this->container['validator'] = function (ContainerInterface $container) {
            return new ValidationFactory($container);
        };
    }
}
