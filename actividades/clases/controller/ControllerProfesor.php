<?php

class ControllerProfesor extends Controller {
    
    function islogin(){
        $session = $this->getSession(); 
        $profesor = $session->getProfesores();
        if($profesor === null){
            $this->getModel()->setData('login', 0); 
        }else{
            $this->getModel()->setData('login', 1);
            /*$this->getModel()->setData('profesor', $profesor->get());
            $this->getPageProfesoresAjax();*/
        }
    }
    
}