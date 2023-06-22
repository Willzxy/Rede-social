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

        $route['autenticar'] = array(
            'route' => '/autenticar',
            'controller' => 'AuthController',
            'action' => 'autenticar'
        );


        $route['sair'] = array(
            'route' => '/sair',
            'controller' => 'AuthController',
            'action' => 'sair'
        );


        $route['timeline'] = array(
            'route' => '/timeline',
            'controller' => 'AppController',
            'action' => 'timeline'
        );

        $route['tweet'] = array(
            'route' => '/tweet',
            'controller' => 'AppController',
            'action' => 'tweet'
        );

        $route['quemSeguir'] = array(
            'route' => '/quemSeguir',
            'controller' => 'AppController',
            'action' => 'quemSeguir'
        );

        $route['acao'] = array(
            'route' => '/acao',
            'controller' => 'AppController',
            'action' => 'acao'
        );

        $this->SetRoute($route);
    }
}


?> 