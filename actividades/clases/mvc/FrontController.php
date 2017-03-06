<?php

class FrontController {

    private $controlador;
    private $modelo;
    private $vista;

    function __construct($nombreRuta = null) {

        $nombreRuta = strtolower($nombreRuta);

        $router = new Router();
        $ruta = $router->getRoute($nombreRuta);

        $nombreModelo = $ruta->getModel();
        $nombreVista = $ruta->getView();
        $nombreControlador = $ruta->getController();

        $this->modelo = new $nombreModelo();
        $this->vista = new $nombreVista($this->modelo);
        $this->controlador = new $nombreControlador($this->modelo);
    }

    function doAction($accion = null, array $parameters = array()) {
        $accion = strtolower($accion);
        if (method_exists($this->controlador, $accion)) {
            $this->controlador->$accion($parameters);
        } else {
            $this->controlador->index();
        }
    }
    
    function getOutput() {
        return $this->vista->render();
    }

}