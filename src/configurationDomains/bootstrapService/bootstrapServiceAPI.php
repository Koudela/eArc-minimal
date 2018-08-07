<?php
/**
 * e-Arc Framework - the explicit Architecture Framework
 * let the folder structure tell what your application is doing
 *
 * @package earc/minimal
 * @link https://github.com/Koudela/eArc-minimal/
 * @copyright Copyright (c) 2018 Thomas Koudela
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace eArc\App\configurationDomains\bootstrapService;

use \eArc\core\Dispatcher;
use \eArc\router\Router;
use \eArc\di\DependencyContainer;

class bootstrapServiceAPI implements bootstrapServiceInterface {

    function __construct()
    {
        $this->bootstrapApp();
    }

    protected function bootstrapApp()
    {
        $routingBasePath = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'web-route';

        $container = $this->bootstrapEArc($routingBasePath);

        $container->set('twig', $this->bootstrapTwig($routingBasePath));

        // start the application
        $container->get(Dispatcher::class)->run();
    }

    protected function bootstrapEArc(string $routingBasePath): DependencyContainer
    {
        $container = new DependencyContainer(null);
        $container->set(DependencyContainer::class, (function () use ($container) {return $container;})());

        $container->set(Dispatcher::class, [Router::class, DependencyContainer::class]);

        $container->set(Router::class, (function() use ($routingBasePath) {
            return new Router(
                $routingBasePath,
                $_SERVER['REQUEST_METHOD'],
                $_GET['url'] ?? DIRECTORY_SEPARATOR,
                null
            );
        })());

        return $container;
    }

    protected function bootstrapTwig(string $routingBasePath): \Twig_Environment
    {
        $loader = new \Twig_Loader_Filesystem($routingBasePath);
        $twig = new \Twig_Environment($loader, array());

        return $twig;
    }
}
