<?php

declare(strict_types=1);

namespace App\services;

class Router{
    private $controller;
    private $action;

    public function __construct($page, $action = null){
        $routes = AVAILABLE_ROUTES;
        $routeActions = ROUTE_ACTIONS;

        $this->controller = $routes[$page] ?? 'RoomController';
        $this->action = $routeActions[$page][$action] ?? 'display';
    }

    public function getController(): object{
        $instance = "App\\controllers\\" . $this->controller;
        return new $instance();
    }

    public function getAction(){
        return $this->action;
    }
}
