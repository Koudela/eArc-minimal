<?php
/**
 * e-Arc Framework - the explizit Architecture Framework 
 * let the folder structure tell what your application is doing
 *
 * @package earc/minimal
 * @link https://github.com/Koudela/eArc-minimal/
 * @copyright Copyright (c) 2018 Thomas Koudela
 * @license http://opensource.org/licenses/MIT MIT License
 */

use eArc\core\Config;
use eArc\core\Dispatcher;
use eArc\core\Router;
use eArc\core\RequestHandler;
use eArc\core\TemplateEngineInjector;
use eArc\di\DependencyContainer;

// autoloader for (composer) dependencies (is PSR-4 compatible)
require __DIR__ . '/../vendor/autoload.php';

// configure dependency injection
// using all posibilities of setting the dependencies
$container = new DependencyContainer(null);
$container->set(DependencyContainer::class, function () use ($container) {return $container;});
$container->load([
    RequestHandler::class => [],
    Config::class => [__DIR__ . '/eArc.config.ini'],
    Router::class => [Config::class, RequestHandler::class],
]);
$container->loadFile(__DIR__ . '/dc.config.php');
$container->set(Dispatcher::class, [Router::class, RequestHandler::class, DependencyContainer::class, TemplateEngineInjector::class]);

// start the application
$container->get(Dispatcher::class);
