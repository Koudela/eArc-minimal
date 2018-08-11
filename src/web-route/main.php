<?php
/**
 * e-Arc Framework - the explicit Architecture Framework
 *
 * @package earc/minimal
 * @link https://github.com/Koudela/eArc-minimal/
 * @copyright Copyright (c) 2018 Thomas Koudela
 * @license http://opensource.org/licenses/MIT MIT License
 */

return function(\earc\router\Router $router, \Psr\Container\ContainerInterface $container)
{
    echo $container->get('twig')->render(implode(DIRECTORY_SEPARATOR, $router->getRealArgs()) . 'index.twig.html', []);
};
