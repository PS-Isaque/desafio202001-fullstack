<?php
/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */

namespace App\v1\Controller\Core;


use App\v1\Request\Core\RequestInterface;
use Illuminate\Validation\Validator;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;

/**
 * @OA\Info(
 *      title="ADDRESS SERVICE",
 *      version="1.0",
 *      description="Here you can find all address service documentation."
 * )
 */
abstract class BaseController
{
    /**
     * @var ContainerInterface $container
     */
    private $container;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * BaseController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return RequestInterface
     */
    public function getRequestManager(): RequestInterface
    {
        return $this->request;
    }

    /**
     * @param RequestInterface $request
     */
    public function setRequestManager(RequestInterface $request)
    {
        $this->request = $request;
    }
}
