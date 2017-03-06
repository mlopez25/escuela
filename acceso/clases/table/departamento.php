<?php

class Departamento{
    
    private $idDepartamento, $departamento;
    
    function __construct($idDepartamento=null, $departamento=null) {
        $this->idDepartamento = $idDepartamento;
        $this->departamento = $departamento;
    }

    function getIdDepartamento() {
        return $this->idDepartamento;
    }
    
    function getDepartamento() {
        return $this->departamento;
    }

    function setIdDepartamento($idDepartamento) {
        $this->idDepartamento = $idDepartamento;
    }
    
    function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    public function __toString() {
        $r = '';
        foreach($this as $key => $valor) {
            $r .= "$key => $valor - ";
        }
        return $r;
    }
    
    function read(ObjectReader $reader = null){
        if($reader===null){
            $reader = 'Request';
        }
        foreach($this as $key => $valor) {
            $this->$key = $reader::read($key);
        }
    }
    
    function get(){
        $nuevoArray = array();
        foreach($this as $key => $valor) {
            $nuevoArray[$key] = $valor;
        }
        return $nuevoArray;
    }
    
    function set(array $array, $inicio = 0) {
        $this->idDepartamento = $array[0 + $inicio];
        $this->departamento = $array[1 + $inicio];
    }
    
    function isValid() {
        if( $this->departamento === null ) {
            return false;
        }
        return true;
    }

}