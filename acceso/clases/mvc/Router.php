<?php

class Router {

    private $rutas = array();

    function __construct() {
        $this->rutas['index'] = new Route('Model', 'View', 'Controller');
        $this->rutas['profesor'] = new Route('ModelProfesor', 'ViewProfesor', 'ControllerProfesor');
        $this->rutas['actividad'] = new Route('ModelActividad', 'ViewProfesor', 'ControllerActividad');
    }

    function getRoute($ruta) {
        if (!isset($this->rutas[$ruta])) {
            return $this->rutas['index'];
        }
        return $this->rutas[$ruta];
    }

}