<?php

class ManageDepartamento {
    
    const TABLA = 'departamento';
    private $db;

    function __construct() {
        $this->db = new DataBase();
    }
    
    function count($parametros = array()) {
        return $this->db->countParameters(self::TABLA, $parametros);
    }
    
    function delete($idDepartamento) {
        return $this->db->deleteParameters(self::TABLA, array('idDepartamento' => $idDepartamento));
    }
    
    function add(Departamento $objeto) {
        return $this->db->insertParameters(self::TABLA, $objeto->get(), false);
    }

    function arrayListDepartamento($pagina = 1, $parametros = array(), $orderby = '1',  $rpp = 10){
        $desde = ($pagina - 1) * $rpp;
        $limit = 'limit ' . $desde . ', ' . $rpp;
        $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby, $limit);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new departamento();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        return $respuesta;
    }
    
    function arrayListDepartamentoSinLimit($pagina = 1, $parametros = array(), $orderby = '1'){
        $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby);
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
    
    function save(Departamento $objeto) {
        $campos = $objeto->get();
        
        if ( empty($objeto->getDepartamento()) ) {
            unset($campos['departamento']);
        }
        
        return $this->db->updateParameters(self::TABLA, $campos, array( 'idDepartamento' => $objeto->getIdDepartamento() ));
    }
    
}