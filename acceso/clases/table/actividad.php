<?php

class Actividad{

    private $idActividad, $profesor, $departamento, $grupo, $titulo, $descripcion, $fecha, $lugar, $horaInicio, $horaFinal, $imagen;
    
    function __construct($idActividad=null, $profesor=null, $departamento=null, $grupo=null, $titulo=null, $descripcion=null, $fecha=null, $lugar=null, $horaInicio=null, $horaFinal=null, $imagen=null) {
        $this->idActividad = $idActividad;
        $this->profesor = $profesor;
        $this->departamento = $departamento;
        $this->grupo = $grupo;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->fecha = $fecha;
        $this->lugar = $lugar;
        $this->horaInicio = $horaInicio;
        $this->horaFinal = $horaFinal;
        $this->imagen = $imagen;
    }

    function getIdActividad() {
        return $this->idActividad;
    }
    
    function getProfesor() {
        return $this->profesor;
    }
    
    function getDepartamento() {
        return $this->departamento;
    }

    function getGrupo() {
        return $this->grupo;
    }
    
    function getTitulo() {
        return $this->titulo;
    }
    
    function getDescripcion() {
        return $this->descripcion;
    }
    
    function getFecha() {
        return $this->fecha;
    }
    
    function getLugar() {
        return $this->lugar;
    }
    
    function getHoraInicio() {
        return $this->horaInicio;
    }
    
    function getHoraFinal() {
        return $this->horaFinal;
    }
    
    function getImagen() {
        return $this->imagen;
    }

    function setIdActividad($idActividad) {
        $this->idActividad = $idActividad;
    }
    
    function setProfesor($profesor){
        $this->profesor = $profesor;
    }
    
    function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }
    
    function setGrupo($grupo) {
        $this->grupo = $grupo;
    }
    
    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    
    function setLugar($lugar) {
        $this->lugar = $lugar;
    }
    
    function setHoraInicio($horaInicio) {
        $this->horaInicio = $horaInicio;
    }
    
    function setHoraFinal($horaFinal) {
        $this->horaFinal = $horaFinal;
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
        $this->idActividad= $array[0 + $inicio];
        $this->profesor = $array[1 + $inicio];
        $this->departamento = $array[2 + $inicio];
        $this->grupo = $array[3 + $inicio];
        $this->titulo = $array[4 + $inicio];
        $this->descripcion = $array[5 + $inicio];
        $this->fecha = $array[6 + $inicio];
        $this->lugar = $array[7 + $inicio];
        $this->horaInicio = $array[8 + $inicio];
        $this->horaFinal = $array[9 + $inicio];
        $this->imagen = $array[10 + $inicio];
    }
    
    function isValid() {
        if( $this->profesor === null && $this->departamento === null && $this->grupo === null ) {
            return false;
        }
        return true;
    }

}