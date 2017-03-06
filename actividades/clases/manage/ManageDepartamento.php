<?php

class ManageDepartamento {
    
    const TABLA = 'departamento';
    private $db;

    function __construct() {
        $this->db = new DataBase();
    }

    function arrayListDepartamento($pagina = 1, $parametros = array(), $orderby = '1',  $rpp = 3){
        $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby, $limit);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new departamento();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        return $respuesta;
    }
    
    function get($idDepartamento){
        $this->db->getCursorParameters(self::TABLA, '*', array('idDepartamento' => $idDepartamento));

        if ($fila = $this->db->getRow()) {
            $objeto = new departamento();
            $objeto->set($fila);
            return $objeto;
        }
        return new departamento();
    }
    
    function busqueda($pagina = 1, $condicion = '', $busqueda = '' , $orderby = '1', $rpp = 6){
        $desde = ($pagina - 1) * $rpp;
        $limit = 'limit ' . $desde . ', ' . $rpp;
        $this->db->getCursorBusqueda(self::TABLA, '*', $condicion, $busqueda, $orderby, $limit);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new departamento();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        
        return $respuesta;
    }
    
}