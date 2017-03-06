<?php

class ManageProfesor {
    
    const TABLA = 'profesor';
    private $db;

    function __construct() {
        $this->db = new DataBase();
    }
    
    function count($parametros = array()) {
        return $this->db->countParameters(self::TABLA, $parametros);
    }
    
    function add(Profesor $objeto) {
        return $this->db->insertParameters(self::TABLA, $objeto->get(), false);
    }
    
    function delete($idProfesor) {
        return $this->db->deleteParameters(self::TABLA, array('idProfesor' => $idProfesor));
    }

    function get($nombre){
        $this->db->getCursorParameters(self::TABLA, '*', array('nombre' => $nombre));

        if ($fila = $this->db->getRow()) {
            $objeto = new profesor();
            $objeto->set($fila);
            return $objeto;
        }
        return new profesor();
    }
    
    function getId($idProfesor){
        $this->db->getCursorParameters(self::TABLA, '*', array('idProfesor' => $idProfesor));

        if ($fila = $this->db->getRow()) {
            $objeto = new profesor();
            $objeto->set($fila);
            return $objeto;
        }
        return new profesor();
    }
    
    function arrayListProfesor($pagina = 1, $parametros = array(), $orderby = '1',  $rpp = 6) {
        $desde = ($pagina - 1) * $rpp;
        $limit = 'limit ' . $desde . ', ' . $rpp;
        $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby, $limit);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new profesor();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        
        return $respuesta;
    }
    
    function arrayListProfesorSinLimite($pagina = 1, $parametros = array(), $orderby = '1') {
        $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new profesor();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        
        return $respuesta;
    }
    
    function save(Profesor $objeto) {
        $campos = $objeto->get();
        
        if ( empty($objeto->getIdProfesor()) ) {
            unset($campos['idProfesor']);
        }
        if ( empty($objeto->getNombre()) ) {
            unset($campos['nombre']);
        }
        if ( empty($objeto->getPassword()) ) {
            unset($campos['password']);
        }
        if ( empty($objeto->getDepartamento()) ) {
            unset($campos['departamento']);
        }
        if ( empty($objeto->getDirectivo()) ) {
            unset($campos['directivo']);
        }
        
        return $this->db->updateParameters(self::TABLA, $campos, array( 'idProfesor' => $objeto->getIdProfesor() ));
    }
    
}