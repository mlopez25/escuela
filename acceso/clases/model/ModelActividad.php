<?php

class ModelActividad extends Model {
    
    /* ********* 
        Saca el grupo, el profesor y el departamento de una actividad según su idActividad
    ********* */
    
    function getDepartamento($idDepartamento){
        $manager = new ManageDepartamento();
        return $manager->get( $idDepartamento );
    }
    
    function getProfesor($idProfesor){
        $manager = new ManageProfesor();
        return $manager->getId( $idProfesor );
    }
    
    function getGrupo($idGrupo){
        $manager = new ManageGrupo();
        return $manager->get( $idGrupo );
    }
    
    function getDepartament($idDepartamento){
        $manager = new ManageDepartamento();
        $departamento = $manager->get( $idDepartamento );
        
        return array(
            'idDepartamento' => $departamento->getIdDepartamento(), 
            'departamento' => $departamento->getDepartamento()
            );
    }
    
    function getGroup($idGrupo){
        $manager = new ManageGrupo();
        $grupo = $manager->get( $idGrupo );
        
        return array(
            'idGrupo' => $grupo->getIdGrupo(), 
            'nombre' => $grupo->getNombre(), 
            'nivel' => $grupo->getNivel()
            );
    }
    
    function getActivity($idActividad){
        $manager = new ManageActividad();
        $actividad = $manager->get( $idActividad );
        
        return array(
            'idActividad' => $actividad->getIdActividad(), 
            'profesor' => $actividad->getProfesor(), 
            'departamento' => $actividad->getDepartamento(),
            'grupo' => $actividad->getGrupo(),
            'titulo' => $actividad->getTitulo(),
            'descripcion' => $actividad->getDescripcion(),
            'fecha' => $actividad->getFecha(),
            'lugar' => $actividad->getLugar(),
            'horaInicio' => $actividad->getHoraInicio(),
            'horaFinal' => $actividad->getHoraFinal(),
            'imagen' => $actividad->getImagen()
            );
    }
    
    /* ********* 
        Saca de la Base de Datos todas las actividades de un profesor
    ********* */
    
    function getActividadesProfesor($idProfesor, $pagina = 1){
        $manager = new ManageActividad();
        $lista = $manager->arrayListActividadesProfesor($idProfesor, $pagina);
        
        $array = [];
        
        foreach ($lista as $i => $actividad) {
            
            $grupo = self::getGrupo( $actividad[grupo] );
            $profesor = self::getProfesor( $actividad[profesor] );
            $departamento = self::getDepartamento( $actividad[departamento] );
            
            $curso = $grupo->getNombre() . ' ' . $grupo->getNivel();
            
            $array[$i] = array( 'idActividad' => $actividad[idActividad], 
                        'profesor' => $profesor->getNombre(),
                        'departamento' => $departamento->getDepartamento(),
                        'grupo' => $curso,
                        'titulo' => $actividad[titulo],
                        'descripcion' => $actividad[descripcion],
                        'fecha' => $actividad[fecha],
                        'lugar' => $actividad[lugar],
                        'horaInicio' => $actividad[horaInicio],
                        'horaFinal' => $actividad[horaFinal],
                        'imagen' => $actividad[imagen]
                        );
        }
        
        return $array;
    }
    
    /* ********* 
        Saca de la Base de Datos todas los departamentos
    ********* */
    
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
    
    /* ********* 
        Saca de la Base de Datos todas los departamentos, y sirve para cuando se hace comprobaciones
        al insertar un nuevo Departamento, para saber si ya se encuentra en la Base de Datos
    ********* */
    
    function arrayDepartamentosSinLimit(){
        $manager = new ManageDepartamento();
        $lista = $manager->arrayListDepartamentoSinLimit($pagina);
        
        $array = [];
        
        foreach ($lista as $i => $departamento) {
            
            $array[$i] = array( 'idDepartamento' => $departamento[idDepartamento], 
                        'departamento' => $departamento[departamento],
                        );
        }
        
        return $array;
    }
    
    /* ********* 
        Saca de la Base de Datos todas los grupos según su paginación
    ********* */
    
    function arrayGrupos($pagina = 1){
        $manager = new ManageGrupo();
        $lista = $manager->arrayListGrupo($pagina);
        
        $array = [];
        
        foreach ($lista as $i => $grupo) {
            $array[$i] = array( 'idGrupo' => $grupo[idGrupo], 
                        'nombre' => $grupo[nombre],
                        'nivel' => $grupo[nivel],
                        );
        }
        
        return $array;
    }
    
    /* ********* 
        Saca de la Base de Datos todas los grupos, y sirve para cuando se hace comprobaciones
        al insertar un nuevo Grupo, para saber si ya se encuentra en la Base de Datos
    ********* */
    
    function arrayGruposSinLimit(){
        $manager = new ManageGrupo();
        $lista = $manager->arrayListGrupoSinLimit();
        
        $array = [];
        
        foreach ($lista as $i => $grupo) {
            
            $array[$i] = array( 'idGrupo' => $grupo[idGrupo], 
                        'nombre' => $grupo[nombre],
                        'nivel' => $grupo[nivel],
                        );
        }
        
        return $array;
    }
    
    /* ********* 
        Insertar Actividad en la Base de Datos
    ********* */
    
    function insertActividad(Actividad $actividad){
        $manager = new ManageActividad();
        return $manager->add($actividad);
    }
    
    /* ********* 
        Insertar Departamento en la Base de Datos
    ********* */
    
    function insertDepartamento(Departamento $departamento){
        $arrayDepartamentos = $this->arrayDepartamentosSinLimit();
        
        foreach($arrayDepartamentos as $d){
            if( ( $d[departamento] == $departamento->getDepartamento() ) ){
                return false;
            }
        }
        
        $manager = new ManageDepartamento();
        return $manager->add($departamento);
    }
    
    /* ********* 
        Insertar Grupo en la Base de Datos
    ********* */
    
    function insertGrupo(Grupo $grupo){
        $arrayGrupos = $this->arrayGruposSinLimit();
        
        foreach($arrayGrupos as $g){
            if( ( $g[nombre] == $grupo->getNombre() ) && ( $g[nivel] == $grupo->getNivel() ) ){
                return false;
            }
        }
        
        $manager = new ManageGrupo();
        return $manager->add($grupo);
    }
    
    /* ********* 
       Eliminar una Actividad de la Base de Datos
    ********* */
    
    function deleteActividad($idActividad){
        $manager = new ManageActividad();
        return $manager->delete($idActividad);
    }
    
    /* ********* 
       Eliminar un Departamento de la Base de Datos
    ********* */
    
    function deleteDepartamento($idDepartamento){
        $manager = new ManageDepartamento();
        return $manager->delete($idDepartamento);
    }
    
    /* ********* 
       Eliminar un Grupo de la Base de Datos
    ********* */
    
    function deleteGrupo($idGrupo){
        $manager = new ManageGrupo();
        return $manager->delete($idGrupo);
    }
    
    /* ********* 
       Editar una Actividad de la Base de Datos
    ********* */
    
    function editActividad($actividad){
        $manager = new ManageActividad();
        return $manager->save($actividad);
    }
    
    /* ********* 
       Editar un Grupo de la Base de Datos
    ********* */
    
    function editGrupo($grupo){
        $manager = new ManageGrupo();
        return $manager->save($grupo);
    }
    
    /* ********* 
       Editar un Departamento de la Base de Datos
    ********* */
    
    function editDepartamento($departamento){
        $arrayDepartamentos = $this->arrayDepartamentosSinLimit();
        
        foreach($arrayDepartamentos as $d){
            if( ( $d[departamento] == $departamento->getDepartamento() ) ){
                return false;
            }
        }
        
        $manager = new ManageDepartamento();
        return $manager->save($departamento);
    }
    
    function countUser(){
        $manager = new ManageActividad();
        return $manager->count();
    }
    
    function countDepartamentos(){
        $manager = new ManageDepartamento();
        return $manager->count();
    }
    
    function countGrupos(){
        $manager = new ManageGrupo();
        return $manager->count();
    }
    
    
}