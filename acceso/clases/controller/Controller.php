<?php

class Controller {

    private $model, $session, $profesor;
    
    function __construct(Model $model) {
        $this->model = $model;
        $this->session = Session::getInstance(Constants::SESSIONNAME); 
    }
    
    function getModel(){
        return $this->model;
    }
    function getSession(){
        return $this->session;
    }
    
    function getUser(){
        return $this->profesor;
    }

    function index() {
        $this->getModel()->setData('pagina', 'index');
    }
    

}