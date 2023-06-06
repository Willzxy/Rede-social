<?php
namespace MF\Init;

abstract class BootStrap {

    private $routes;

    abstract protected function InitRoutes();

    public function __construct(){
        $this->InitRoutes();
        $this->Run($this->GetUrl());
    }

    public function GetRoutes(){
        return $this->routes;
    }

    public function SetRoute($attr){
        $this->routes = $attr;
    }

    protected function Run($url){
        $err404 = true;

        foreach ($this->GetRoutes() as $key => $value) {
            if($url == $value['route']){
                $class = "\\App\\Controllers\\".ucfirst($value['controller']);
                $action = $value['action'];

                $controller = new $class;
                $controller->$action();

                $err404 = false;
            }
        }

        if($err404) { include_once "../App/Views/err404.phtml"; }
    }

    public function GetUrl() {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}
 
?>