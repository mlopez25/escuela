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
    
    function arrayListActividades($pagina = 1, $parametros = array(), $orderby = '1',  $rpp = 7) {
        $desde = ($pagina - 1) * $rpp;
        $limit = 'limit ' . $desde . ', ' . $rpp;
        $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby, $limit);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new actividad();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        
        return $respuesta;
    }
    
    function arrayActividadesFecha($pagina = 1, $parametros = array(), $orderby = '1',  $rpp = 7) {
        $desde = ($pagina - 1) * $rpp;
        $limit = 'limit ' . $desde . ', ' . $rpp;
        $this->db->getCursorParameters(self::TABLA, '*', $parametros, fecha, ASC);
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

    function actividadesPor($pagina = 1, $parametros = array(), $orderby = '1'){
        $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new actividad();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        return $respuesta;
    }
    
    function busqueda($pagina = 1, $condicion = '', $busqueda = '' , $orderby = '1', $rpp = 6){
        $desde = ($pagina - 1) * $rpp;
        $limit = 'limit ' . $desde . ', ' . $rpp;
        $this->db->getCursorBusqueda(self::TABLA, '*', $condicion, $busqueda, $orderby, $limit);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new actividad();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        
        return $respuesta;
    }
    
}