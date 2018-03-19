<?php

namespace Svycka\Codeception\Module;

use Codeception\Lib\Framework;
use Codeception\TestInterface;
use Codeception\Configuration;
use Svycka\Codeception\Lib\Connector\ZendExpressive as ZendExpressiveConnector;
use Codeception\Lib\Interfaces\DoctrineProvider;

/**
 * This module allows you to run tests inside Zend Expressive 3.
 *
 * Uses `config/container.php` file by default.
 *
 * ## Config
 *
 * * container: relative path to file which returns Container (default: `config/container.php`)
 * * orm_service: the service name for `Doctrine\ORM\EntityManager` within container (default: `doctrine.entity_manager.orm_default`)
 *
 * ## API
 *
 * * application - instance of `\Zend\Expressive\Application`
 * * container - instance of `\Psr\Container\ContainerInterface`
 * * client - BrowserKit client
 *
 */
final class ZendExpressive extends Framework implements DoctrineProvider
{
    protected $config = [
        'container' => 'config/container.php',
        'orm_service' => 'doctrine.entity_manager.orm_default',
        'app_dir' => '',
    ];

    /**
     * @var \Codeception\Lib\Connector\ZendExpressive
     */
    public $client;

    /**
     * @var \Psr\Container\ContainerInterface
     */
    public $container;

    /**
     * @var \Zend\Expressive\Application
     */
    public $application;

    protected $responseCollector;

    public function _initialize() : void
    {
        $cwd = getcwd();
        $projectDir = Configuration::projectDir() . $this->config['app_dir'];
        chdir($projectDir);
        $this->container = require $projectDir . $this->config['container'];
        $app = $this->container->get('Zend\Expressive\Application');
        $factory = $this->container->get(\Zend\Expressive\MiddlewareFactory::class);

        $pipelineFile = $projectDir . 'config/pipeline.php';
        if (file_exists($pipelineFile)) {
            (require $pipelineFile)($app, $factory, $this->container);
        }
        $routesFile = $projectDir . 'config/routes.php';
        if (file_exists($routesFile)) {
            (require $routesFile)($app, $factory, $this->container);
        }
        chdir($cwd);

        $this->application = $app;
    }

    public function _before(TestInterface $test) : void
    {
        $this->client = new ZendExpressiveConnector();
        $this->client->setApplication($this->application);
    }

    public function _after(TestInterface $test) : void
    {
        //Close the session, if any are open
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_write_close();
        }
    }

    public function _getEntityManager() : \Doctrine\ORM\EntityManagerInterface
    {
        $service = $this->config['orm_service'];
        if (!$this->container->has($service)) {
            throw new \PHPUnit\Framework\AssertionFailedError("Service $service is not available in container");
        }

        return $this->container->get($service);
    }
}
