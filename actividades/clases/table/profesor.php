<?php

class Profesor{
    
    private $idProfesor, $nombre, $password, $departamento, $directivo, $imagen;
    
    function __construct($idProfesor=null, $nombre=null, $password=null, $departamento=null, $directivo=null, $imagen=null) {
        $this->idProfesor = $idProfesor;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->departamento = $departamento;
        $this->imagen = $imagen;
    }

    function getIdProfesor() {
        return $this->idProfesor;
    }
    
    function getNombre() {
        return $this->nombre;
    }
    
    function getPassword() {
        return $this->password;
    }

    function getDepartamento() {
        return $this->departamento;
    }
    
    function getDirectivo() {
        return $this->directivo;
    }
    
    function getImagen(){
        return $this->imagen;
    }

    function setIdProfesor($idProfesor) {
        $this->idProfesor = $idProfesor;
    }
    
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    function setPassword($password) {
        $this->password = $password;
    }

    function setDepartamento($departamento) {
        $this->nivel = $departamento;
    }
    
    function setDirectivo($directivo) {
        $this->directivo = $directivo;
    }
    
    function setImagen($imagen) {
        $this->imagen = $imagen;
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
        $this->idProfesor = $array[0 + $inicio];
        $this->nombre = $array[1 + $inicio];
        $this->password = $array[2 + $inicio];
        $this->departamento = $array[3 + $inicio];
        $this->directivo = $array[4 + $inicio];
        $this->imagen = $array[5 + $inicio];
    }
    
    function isValid() {
        if( $this->nombre === null && $this->password === null ) {
            return false;
        }
        return true;
    }

}