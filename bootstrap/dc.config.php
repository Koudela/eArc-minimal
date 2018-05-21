<?php

use eArc\core\TemplateEngineInjector;

return [    
    TemplateEngineInjector::class => ['twig', (function() {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../src/route');
        $twig = new \Twig_Environment($loader, array());
        return $twig;        
    })()]
];
