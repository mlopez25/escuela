<?php

class ControllerProfesor extends Controller {
    
    function profesorespage(){
        $pagina = Request::read('pagina');
        $this->listProfesores($pagina);
    }
    
    function logout(){
        $this->getSession()->destroy();
        header('Location: index.php');
        exit();
    }
    
    function islogin(){
        $session = $this->getSession(); 
        $profesor = $session->getUser();
        
        if($profesor === null){
            $this->getModel()->setData('login', 0); 
        }else{
            $this->getModel()->setData('login', 1);
            $this->getModel()->setData( 'profesor', $profesor);
        }
    }
    
    function login(){
        $readNombre = Request::read('nombre');
        $readPassword = Request::read('password');
        
        $loguearse = $this->getModel()->doLogin($readNombre, $readPassword);

        if($loguearse === false){
            $this->getModel()->setData('login', 0);
        } else {
            $this->getSession()->setUser($loguearse);
            $this->getModel()->setData('login', 1);
            $this->getModel()->setData('profesor', $loguearse);
        }
    }
    
    function listProfesores($pagina){
        $total = $this->getModel()->countProfesores();
        $controllerpage = new PageController($total, $pagina, $rpp=6);
        $profesores = $this->getModel()->arrayProfesores($controllerpage->getPage());
        $this->getModel()->setData('profesores', $profesores);
        $this->getModel()->setData('page', $controllerpage->getPage());
        $this->getModel()->setData('pages', $controllerpage->getPages());
    }
    
    function doinsert(){
        $readNombre = Request::read('nombre');
        $readPassword = Request::read('password');
        $readDepartamento = Request::read('departamento');
        $readDirectivo = Request::read('directivo');
        $readImagen = Request::read('imagen');
        
        $profesor = new profesor();
        $profesor->setNombre($readNombre);
        $profesor->setPassword($readPassword);
        $profesor->setDepartamento($readDepartamento);
        $profesor->setDirectivo($readDirectivo);
        $profesor->setImagen($readImagen);

        $p = $this->getModel()->insertProfesor($profesor);
        
        if( $p == false){
            $this->getModel()->setData('p', 0);
        }else{
            $this->getModel()->setData('p', 1);
        }
    }
    
    function dodelete(){
        $readId = Request::read('idProfesor');
        $this->getModel()->delete($readId);
    }
    
    function getProfesorDepartamentos(){
        $readId = Request::read('id');
        $profesor = $this->getModel()->get($readId);
        $departamentos = $this->getModel()->arrayDepartamento();
        
        $this->getModel()->setData('profesor', $profesor);
        $this->getModel()->setData('departamentos', $departamentos);
    }
    
    function edit(){

        $readId = Request::read('id');
        $readNombre = Request::read('nombre');
        $readNombrepk = Request::read('nombrepk');
        $readPassword = Request::read('password');
        $readDepartamento = Request::read('departamento');
        $readDirectivo = Request::read('directivo');
        $readImagen = Request::read('imagen');
        
        $profesor = new profesor();
        $profesor->setIdProfesor($readId);
        
        if ( !empty($readNombre) ) {
            if( $readNombre !== $readNombrepk ){
                $profesor->setNombre($readNombre); 
            }
        }
        
        if ( !empty($readPassword) ) {
            $profesor->setPassword($readPassword); 
        }
        
        if ( !empty($readDepartamento) ) {
            $profesor->setDepartamento($readDepartamento); 
        }
        
        if ( !empty($readDirectivo) ) {
            $profesor->setDirectivo($readDirectivo); 
        }
        
        if ( !empty($readImagen) ){
            $profesor->setImagen($readImagen);
        }
        
        $r = $this->getModel()->editProfesor($profesor);
        
        if($r === false){
            $this->getModel()->setData('p', 0);
        } else{
            $profesor = $this->getModel()->get($readId);
            $departamentos = $this->getModel()->arrayDepartamento();
            $this->getModel()->setData('p', 1);
            $this->getModel()->setData('profesor', $profesor);
            $this->getModel()->setData('departamentos', $departamentos);
        }
        
    }
    
}