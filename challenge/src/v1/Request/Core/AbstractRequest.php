<?php
namespace App\v1\Request\Core;

use App\v1\Util\Validation\ValidationFactory;
use Psr\Container\ContainerInterface;

abstract class AbstractRequest implements RequestInterface
{
    /**
     * @var ValidationFactory
     */
    private $validator;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * AbstractRequest constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
        $this->setValidator($this->getContainer()->get('validator'));
    }

    /**
     * @return ValidationFactory
     */
    public function getValidator(): ValidationFactory
    {
        return $this->validator;
    }

    /**
     * @param ValidationFactory $validator
     */
    public function setValidator(ValidationFactory $validator)
    {
        $this->validator = $validator;
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
}
