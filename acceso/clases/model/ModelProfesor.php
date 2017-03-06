<?php

class ModelProfesor extends Model {
    
    function doLogin($nombre, $password){
        $manager = new ManageProfesor();
        $profesor =  $manager->get($nombre);
        
        if($nombre === $profesor->getNombre() && $password === $profesor->getPassword() ){
            return array('id' => $profesor->getIdProfesor(), 'nombre' => $profesor->getNombre(), 'departamento' => $profesor->getDepartamento(), 'directivo' => $profesor->getDirectivo());
        }
        return false;
    }
    
    function get($idProfesor){
        $manager = new ManageProfesor();
        $profesor =  $manager->getId($idProfesor);
        
        return array(
            'idProfesor' => $profesor->getIdProfesor(), 
            'nombre' => $profesor->getNombre(), 
            'password' => $profesor->getPassword(),
            'departamento' => $profesor->getDepartamento(), 
            'directivo' => $profesor->getDirectivo(),
            'imagen' => $profesor->getImagen()
            );
    }
    
    function arrayProfesores($pagina = 1){
        $manager = new ManageProfesor();
        $lista = $manager->arrayListProfesor($pagina);
        
        $managerDep = new ManageDepartamento();
        
        $array = [];
        
        foreach ($lista as $i => $profesor) {
            
            $departamento = $managerDep->get($profesor[departamento]);
            $directivo = '';
            if($profesor[directivo] == 0){
                $directivo = 'No Directivo';
            } else {
                $directivo = 'Directivo';
            }
            
            $array[$i] = array( 'idProfesor' => $profesor[idProfesor], 
                        'nombre' => $profesor[nombre],
                        'departamento' => $departamento->getDepartamento(),
                        'directivo' => $directivo,
                        'imagen' => $profesor[imagen]
                        );
        }
        
        return $array;
    }
    
    /* ********* 
        Saca de la Base de Datos todas los profesores, y sirve para cuando se hace comprobaciones
        al insertar un nuevo Profesor, para saber si ya se encuentra en la Base de Datos
    ********* */
    
    function arrayProfesoresSinLimite(){
        $manager = new ManageProfesor();
        $lista = $manager->arrayListProfesorSinLimite();
        
        $managerDep = new ManageDepartamento();
        
        $array = [];
        
        foreach ($lista as $i => $profesor) {
            
            $departamento = $managerDep->get($profesor[departamento]);
            $directivo = '';
            if($profesor[directivo] == 0){
                $directivo = 'No Directivo';
            } else {
                $directivo = 'Directivo';
            }
            
            $array[$i] = array( 'idProfesor' => $profesor[idProfesor], 
                        'nombre' => $profesor[nombre],
                        'departamento' => $departamento->getDepartamento(),
                        'directivo' => $directivo,
                        'imagen' => $profesor[imagen]
                        );
        }
        
        return $array;
    }
    
    /* ********* 
        Insertar Profesor en la Base de Datos
    ********* */
    
    function insertProfesor(Profesor $profesor){
        $arrayProfesores = $this->arrayProfesoresSinLimite();
        
        foreach($arrayProfesores as $p){
            if( ( $p[nombre] == $profesor->getNombre() ) ){
                return false;
            }
        }
        
        $manager = new ManageProfesor();
        return $manager->add($profesor);
    }
    
    /* ********* 
       Eliminar un Profesor de la Base de Datos
    ********* */
    
    function delete($idProfesor){
        $manager = new ManageProfesor();
        return $manager->delete($idProfesor);
    }
    
    function arrayDepartamento($pagina = 1){
        $manager = new ManageDepartamento();
        $lista = $manager->arrayListDepartamento($pagina);
        
        $array = [];
        
        foreach ($lista as $i => $departamento) {
            
            $array[$i] = array( 'idDepartamento' => $departamento[idDepartamento], 
                        'departamento' => $departamento[departamento],
                        );
        }
        
        return $array;
    }
    
    function editProfesor(Profesor $profesor){
        $arrayProfesores = $this->arrayProfesoresSinLimite();
        
        foreach($arrayProfesores as $p){
            if( ( $p[nombre] == $profesor->getNombre() ) ){
                return false;
            }
        }
        
        $manager = new ManageProfesor();
        return $manager->save($profesor);
    }
    
    function countProfesores(){
        $manager = new ManageProfesor();
        return $manager->count();
    }
    
}