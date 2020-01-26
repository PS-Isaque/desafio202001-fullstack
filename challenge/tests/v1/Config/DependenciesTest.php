<?php
/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */

namespace Test\v1\Config;

use App\v1\Config\Dependencies;
use App\v1\Controller\AddressController;
use App\v1\Request\AddressRequest;
use App\v1\Util\Validation\ValidationFactory;
use Illuminate\Database\Capsule\Manager;
use Psr\Container\ContainerInterface;
use Slim\Views\PhpRenderer;
use Tests\BaseTestCase;

class DependenciesTest extends BaseTestCase
{
    /**
     * Test dependencies injection and generation
     */
    public function testMake()
    {
        $dependencies = new Dependencies($this->getApp());
        $container = $dependencies->make();

        $this->assertInstanceOf(ContainerInterface::class, $container);
        $this->assertInstanceOf(\Closure::class, $container->get('errorHandler'));
        $this->assertInstanceOf(PhpRenderer::class, $container->get('renderer'));
        $this->assertInstanceOf(Manager::class, $container->get('db'));
        $this->assertInstanceOf(AddressRequest::class, $container->get(AddressRequest::class));
        $this->assertInstanceOf(AddressController::class, $container->get(AddressController::class));
        $this->assertInstanceOf(ValidationFactory::class, $container->get('validator'));
    }
}