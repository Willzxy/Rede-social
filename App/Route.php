<?php

namespace App;
use MF\Init\BootStrap;

class Route extends BootStrap {
    protected function InitRoutes(){
        $route['home'] = array(
            'route' => '/',
            'controller' => 'IndexController',
            'action' => 'index'
        );

        $route['inscreverse'] = array(
            'route' => '/inscreverse',
            'controller' => 'IndexController',
            'action' => 'inscreverse'
        );

        $route['registrar'] = array(
            'route' => '/registrar',
            'controller' => 'IndexController',
            'action' => 'registrar'
        );

        $this->SetRoute($route);
    }
}


?> 