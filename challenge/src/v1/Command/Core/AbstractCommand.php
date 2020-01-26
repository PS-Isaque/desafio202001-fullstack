<?php

namespace App\v1\Command\Core;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;

/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */
class AbstractCommand extends Command
{

    /**
     * @var ContainerInterface $container
     */
    private $container;


    /**
     * BaseCommand constructor.
     * @param ContainerInterface $container
     * @param null $name
     */
    public function __construct(ContainerInterface $container, $name = null)
    {
        parent::__construct($name);
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
}
