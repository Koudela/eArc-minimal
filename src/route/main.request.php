<?php

(function() use ($twig, $route, $args, $container)
{
    echo $twig->render($route . 'index.html', ['active' => '']);
})();
