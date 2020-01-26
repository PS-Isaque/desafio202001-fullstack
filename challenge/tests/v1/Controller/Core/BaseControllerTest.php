<?php

/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */
class BaseControllerTest extends \Tests\BaseTestCase
{
    public function testGetAndSetters()
    {
        $controller = new \App\v1\Controller\AddressController($this->getContainer());
        $controller->setRequestManager(new \App\v1\Request\AddressRequest($this->getContainer()));

        $this->assertInstanceOf(\Psr\Container\ContainerInterface::class, $controller->getContainer());
        $this->assertInstanceOf(\App\v1\Request\Core\RequestInterface::class, $controller->getRequestManager());
    }
}