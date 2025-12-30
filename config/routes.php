<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Route\DashedRoute;

return function (RouteBuilder $routes) {
    $routes->scope('/', function (RouteBuilder $builder) {
        $builder->connect('/', ['controller' => 'Tattoos', 'action' => 'index']);
        $builder->connect('/upload', ['controller' => 'Tattoos', 'action' => 'add']);
        $builder->fallbacks(DashedRoute::class);
    });
};

