<?php

namespace Fin\Plugins;

use Aura\Router\RouterContainer;
use Fin\ServiceContainerInterface;

class RoutePlugin
{
    public function register(ServiceContainerInterface $container)
    {
        $routerContainer = new RouterContainer();
        // Registrar as rotas da aplicação
        $map = $routerContainer->getMap();
        // Identificar a rota que está sendo acessada
        $matcher = $routerContainer->getMatcher();
        // Gerar links com base nas rotas registradas
        $generator = $routerContainer->getGenerator();
        $container->add('routing', $map);
        $container->add('routing.matcher', $matcher);
        $container->add('routing.generator', $generator);
    }
}