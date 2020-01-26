<?php

namespace Tests;

use App\v1\Config\DB;
use App\v1\Config\Dependencies;
use App\v1\Config\Routes;
use App\v1\Config\Settings;
use App\v1\Model\Address;
use Illuminate\Database\Capsule\Manager as CapsuleManager;
use Phinx\Config\Config as PhinxConfig;
use Phinx\Migration\Manager as MigrationManager;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\NullOutput;

/**
 * This is an example class that shows how you could set up a method that
 * runs the application. Note that it doesn't cover all use-cases and is
 * tuned to the specifics of this skeleton app, so if your needs are
 * different, you'll need to change it.
 */
class BaseTestCase extends TestCase
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
     * @var bool
     */
    protected $runMigration = false;

    /**
     * Use middleware when running application?
     *
     * @var bool
     */
    protected $withMiddleware = true;

    /**
     * Setup tests environment
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Instantiate the application
        $this->setApp(new App(Settings::get()));
        $this->setContainer($this->getApp()->getContainer());

        // Set up dependencies
        $dependencies = new Dependencies($this->getApp());
        $dependencies->make();

        // Register routes
        $routes = new Routes($this->getApp());
        $routes->make();
    }

    /**
     * Process the application given a request method and URI
     *
     * @param string $requestMethod the request method (e.g. GET, POST, etc.)
     * @param string $requestUri the request URI
     * @param array|object|null $requestData the request data
     * @return \Slim\Http\Response
     */
    public function runApp($requestMethod, $requestUri, $requestData = null)
    {
        // Create a mock environment for testing with
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        // Set up a request object based on the environment
        $request = Request::createFromEnvironment($environment);

        // Add request data, if it exists
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        // Set up a response object
        $response = new Response();

        // Process the application
        $response = $this->getApp()->process($request, $response);

        // Return the response
        return $response;
    }

    /**
     * Run migration and setup eloquent
     */
    public function runMigration()
    {
        // Set up phinx configuration
        $env = getenv('APPLICATION_ENV');
        $config = PhinxConfig::fromPhp(__DIR__ . '/../phinx.php');

        // Setup migration parameters and configurations
        $migrationManager = new MigrationManager($config, new ArgvInput(), new NullOutput());
        $connection = $migrationManager->getEnvironment($env)->getAdapter()->getConnection();
        $migrationManager->migrate($env);

        // Setup eloquent connection
        $capsule = new CapsuleManager();
        $capsule->addConnection(DB::getEloquentTestingConfig());
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        // Setup eloquent connection to use the same phinx opened connection
        $capsule->getDatabaseManager()->connection('default')->setPdo($connection);

        $container = $this->getContainer();
        $container['db'] = $capsule;

        $this->setContainer($container);
    }

    /**
     * @return mixed
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param mixed $app
     */
    public function setApp($app)
    {
        $this->app = $app;
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
