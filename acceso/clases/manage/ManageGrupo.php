<?php

class ManageGrupo {
    
    const TABLA = 'grupo';
    private $db;

    function __construct() {
        $this->db = new DataBase();
    }
    
    function count($parametros = array()) {
        return $this->db->countParameters(self::TABLA, $parametros);
    }
    
    function add(Grupo $objeto) {
        return $this->db->insertParameters(self::TABLA, $objeto->get(), false);
    }
    
    function delete($idGrupo) {
        return $this->db->deleteParameters(self::TABLA, array('idGrupo' => $idGrupo));
    }

    function arrayListGrupo($pagina = 1, $parametros = array(), $orderby = '1',  $rpp = 10){
        $desde = ($pagina - 1) * $rpp;
        $limit = 'limit ' . $desde . ', ' . $rpp;
        $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby, $limit);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new grupo();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        return $respuesta;
    }
    
    function arrayListGrupoSinLimit($pagina = 1, $parametros = array(), $orderby = '1'){
        $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby);
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
    
    function save(Grupo $objeto) {
        $campos = $objeto->get();
        
        if ( empty($objeto->getNombre()) ) {
            unset($campos['nombre']);
        }
        if ( empty($objeto->getNivel()) ) {
            unset($campos['nivel']);
        }
        
        return $this->db->updateParameters(self::TABLA, $campos, array( 'idGrupo' => $objeto->getIdGrupo() ));
    }
    
}