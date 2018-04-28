<?php

namespace Fin;

use Xtreamwayz\Pimple\Container;

class Application
{
    private $serviceContainer;

    public function __construct(ServiceContainerInterface $serviceContainer)
    {
        $this->serviceContainer = new Container;
    }

    public function service( $name )
    {
        return $this->serviceContainer->get($name);
    }

    public function addService(string $name, $service)
    {
        if( is_callable($service) ){
            $this->serviceContainer->addLazy($name, $service);
        }else{
            $this->serviceContainer->add($name, $service);
        }
    }
}