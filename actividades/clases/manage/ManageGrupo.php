<?php

class ManageGrupo {
    
    const TABLA = 'grupo';
    private $db;

    function __construct() {
        $this->db = new DataBase();
    }

    function arrayListGrupo($pagina = 1, $parametros = array(), $orderby = '1',  $rpp = 3){
        $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby, $limit);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new grupo();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        return $respuesta;
    }
    
    function get($idGrupo){
        $this->db->getCursorParameters(self::TABLA, '*', array('idGrupo' => $idGrupo));

        if ($fila = $this->db->getRow()) {
            $objeto = new grupo();
            $objeto->set($fila);
            return $objeto;
        }
        return new grupo();
    }
    
    function getGrupos($pagina = 1, $parametros = array(), $orderby = '2'){
        $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new grupo();
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
            $objeto = new grupo();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        
        return $respuesta;
    }
    
}