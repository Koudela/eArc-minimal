<?php

return function(\earc\router\Router $router, \Psr\Container\ContainerInterface $container)
{
    echo $container->get('twig')->render(implode(DIRECTORY_SEPARATOR, $router->getRealArgs()) . 'index.html', []);
};
