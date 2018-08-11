<?php
/**
 * e-Arc Framework - the explicit Architecture Framework
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
        $container = new DependencyContainer();

        $container->set(Dispatcher::class, [Router::class, DependencyContainer::class]);

        // usage of the inline factory instead of the array configuration approach
        // otherwise if any of the arguments matches a container key we are in trouble
        $container->set(Router::class, function() use ($routingBasePath) {
            return new Router(
                $routingBasePath,
                filter_input(INPUT_SERVER, 'REQUEST_METHOD'),
                filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL) ?? '/',
                null
            );
        });

        return $container;
    }

    protected function bootstrapTwig(string $routingBasePath): \Twig_Environment
    {
        $loader = new \Twig_Loader_Filesystem($routingBasePath);
        $twig = new \Twig_Environment($loader, array());

        return $twig;
    }
}
