<?php

class ManageActividad {
    
    const TABLA = 'actividad';
    private $db;

    function __construct() {
        $this->db = new DataBase();
    }
    
    function count($parametros = array()) {
        return $this->db->countParameters(self::TABLA, $parametros);
    }
    
    function add(Actividad $objeto) {
        return $this->db->insertParameters(self::TABLA, $objeto->get(), false);
    }
    
    function delete($idActividad) {
        return $this->db->deleteParameters(self::TABLA, array('idActividad' => $idActividad));
    }
    
    function arrayListActividadesProfesor($idProfesor, $pagina = 1, $orderby = '1',  $rpp = 6) {
        $desde = ($pagina - 1) * $rpp;
        $limit = 'limit ' . $desde . ', ' . $rpp;
        $this->db->getCursorParameters(self::TABLA, '*', array('profesor' => $idProfesor), $orderby . ' DESC', $limit);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new actividad();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        
        return $respuesta;
    }

    function get($idActividad){
        $this->db->getCursorParameters(self::TABLA, '*', array('idActividad' => $idActividad));

        if ($fila = $this->db->getRow()) {
            $objeto = new actividad();
            $objeto->set($fila);
            return $objeto;
        }
        return new actividad();
    }
    
    function save(Actividad $objeto) {
        $campos = $objeto->get();
        
        if ( empty($objeto->getProfesor()) ) {
            unset($campos['profesor']);
        }
        
        if ( empty($objeto->getDepartamento()) ) {
            unset($campos['departamento']);
        }
        
        if ( empty($objeto->getGrupo()) ) {
            unset($campos['grupo']);
        }
        
        if ( empty($objeto->getTitulo()) ) {
            unset($campos['titulo']);
        }
        
        if ( empty($objeto->getDescripcion()) ) {
            unset($campos['descripcion']);
        }
        
        if ( empty($objeto->getFecha()) ) {
            unset($campos['fecha']);
        }
        
        if ( empty($objeto->getLugar()) ) {
            unset($campos['lugar']);
        }
        
        if ( empty($objeto->getHoraInicio()) ) {
            unset($campos['horaInicio']);
        }
        
        if ( empty($objeto->getHoraFinal()) ) {
            unset($campos['horaFinal']);
        }
        
        if ( empty($objeto->getImagen()) ) {
            unset($campos['imagen']);
        }
        
        return $this->db->updateParameters(self::TABLA, $campos, array( 'idActividad' => $objeto->getIdActividad() ));
    }
    
}