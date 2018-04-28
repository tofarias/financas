<?php
declare(strict_types=1);
namespace Fin\Plugins;

use Aura\Router\RouterContainer;
use Fin\ServiceContainerInterface;
use Psr\Http\Message\RequestInterface;
use Interop\Container\Containerinterface;

class RoutePlugin
{
    public function register(ServiceContainerInterface $container)
    {
        $routerContainer = new RouterContainer();
        // Registra as rotas da aplicação
        $map = $routerContainer->getMap();
        // Identifica a rota que está sendo acessada
        $matcher = $routerContainer->getMatcher();
        // Gera links com base nas rotas registradas
        $generator = $routerContainer->getGenerator();

        $request = $this->getRequest();

        $container->add('routing', $map);
        $container->add('routing.matcher', $matcher);
        $container->add('routing.generator', $generator);
        $container->add(RequestInterface::class, $request);

        $container->addLazy('route', function( ContainerInterface $container){
            $matcher = $container->get('routing.matcher');
            $request = $container->get(RequestInterface::class);
            return $matcher->match( $request );
        });
    }

    protected function getRequest() : RequestInterface
    {
        return ServerRequestFactory::fromGlobals(
            $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
        );
    }
}