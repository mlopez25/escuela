<?php

class ModelActividades extends Model {
    
    private $indice; 
    
    function countUser(){
        $manager = new ManageActividad();
        return $manager->count();
    }
    
    
    /* ********* 
        Saca el grupo, el profesor y el departamento de una actividad según su idActividad
    ********* */
    
    function getDepartamento($idDepartamento){
        $manager = new ManageDepartamento();
        return $manager->get( $idDepartamento );
    }
    
    function getProfesor($idProfesor){
        $manager = new ManageProfesor();
        return $manager->get( $idProfesor );
    }
    
    function getGrupo($idGrupo){
        $manager = new ManageGrupo();
        return $manager->get( $idGrupo );
    }
    
    
    /* *********
        Saca un listado de todas las Actividades de la Base de Datos
    ********* */
    
    function getActividades($pagina = 1){
        $manager = new ManageActividad();
        $lista = $manager->arrayListActividades($pagina);
        
        $array = [];
        $cont = 0;
        
        foreach ($lista as $i => $actividad) {

            if( $this->indice !== $actividad[idActividad] ){
            
                $grupo = self::getGrupo( $actividad[grupo] );
                $profesor = self::getProfesor( $actividad[profesor] );
                $departamento = self::getDepartamento( $actividad[departamento] );
                
                $curso = $grupo->getNombre() . ' ' . $grupo->getNivel();
                
                $array[$cont] = array( 'idActividad' => $actividad[idActividad], 
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
                $cont = $cont+1;
            }
        }
        
        return $array;
    }
    
    
    /* *********
        Saca un listado de todas las Actividades de la Base de Datos, pero ordenadas por fecha
        ascendente. Y compara con la fecha actual para buscar la actividad que esté más próxima
        de ocurrir
    ********* */
    
    function getActividadesFecha($pagina = 1){
        $manager = new ManageActividad();
        $lista = $manager->arrayActividadesFecha($pagina);
        
        $fechaHoy = new DateTime("now");
        
        for( $i = 0; $i <= $lista.length+1; $i++ ){
            $actividad = $lista[$i];
            
            if( $fechaHoy > $actividad[fecha] ){
                $menor = $lista[$i-1];
                $this->indice = $menor[idActividad];
            }else{
                break;
            }
            
        }
        
        $grupo = self::getGrupo( $menor[grupo] );
        $profesor = self::getProfesor( $menor[profesor] );
        $departamento = self::getDepartamento( $menor[departamento] );
        
        $curso = $grupo->getNombre() . ' ' . $grupo->getNivel();
        
        return array( 'idActividad' => $menor[idActividad], 
                        'profesor' => $profesor->getNombre(),
                        'departamento' => $departamento->getDepartamento(),
                        'grupo' => $curso,
                        'titulo' => $menor[titulo],
                        'descripcion' => $menor[descripcion],
                        'fecha' => $menor[fecha],
                        'lugar' => $menor[lugar],
                        'horaInicio' => $menor[horaInicio],
                        'horaFinal' => $menor[horaFinal],
                        'imagen' => $menor[imagen]
                        );

    }
    
    function getActividadesProximas(){
        $manager = new ManageActividad();
        $lista = $manager->arrayActividadesFecha();
        
        $fechaHoy = new DateTime("now");
        
        for( $i = 0; $i <= $lista.length+1; $i++ ){
            $actividad = $lista[$i];
            
            if( $fechaHoy > $actividad[fecha] ){
                $this->indice = $actividad[idActividad];
            }else{
                break;
            }
            
        }
        
        $grupo = self::getGrupo( $actividad[grupo] );
        $profesor = self::getProfesor( $actividad[profesor] );
        $departamento = self::getDepartamento( $actividad[departamento] );
        
        $curso = $grupo->getNombre() . ' ' . $grupo->getNivel();
        
        $array = [];
        
        for( $i = 0; $i < 5; $i++ ){
            $array[$i] = array( 'idActividad' => $lista[$i][idActividad], 
                    'titulo' => $lista[$i][titulo],
                    );
        }
        
        return $array;

    }
    
    
    /* *********
        Saca un array con todos los valores de una actividad según el id de la Actividad
    ********* */
    
    function getActividad($idActividad){
        $manager = new ManageActividad();
        $actividad = $manager->get($idActividad);
        
        $grupo = self::getGrupo( $actividad->getGrupo() );
        $profesor = self::getProfesor( $actividad->getProfesor() );
        $departamento = self::getDepartamento( $actividad->getDepartamento() );
        
        if($actividad->getTitulo() !== null && $actividad->getProfesor() !== null ){
            $curso = $grupo->getNombre() . ' ' . $grupo->getNivel();
            
            return array( 'idActividad' => $actividad->getIdActividad(), 
                        'profesor' => $profesor->getNombre(),
                        'departamento' => $departamento->getDepartamento(),
                        'grupo' => $curso,
                        'titulo' => $actividad->getTitulo(),
                        'descripcion' => $actividad->getDescripcion(),
                        'fecha' => $actividad->getFecha(),
                        'lugar' => $actividad->getLugar(),
                        'horaInicio' => $actividad->getHoraInicio(),
                        'horaFinal' => $actividad->getHoraFinal(),
                        'imagen' => $actividad->getImagen()
                        );
        }
        return false;
    }
    
    function getGrupos(){
        $manager = new ManageGrupo();
        $lista = $manager->getGrupos();
        
        $array = [];
        
        foreach ($lista as $i => $grupo) {
            
            $array[$i] = array( 'idGrupo' => $grupo[idGrupo], 
                        'nombre' => $grupo[nombre],
                        'nivel' => $grupo[nivel],
                        );
        }
        
        return $array;
    }
    
    function getProfesores(){
        $manager = new ManageProfesor();
        $lista = $manager->getProfesores();
        
        $array = [];
        
        foreach ($lista as $i => $profesor) {
            
            $array[$i] = array( 'idProfesor' => $profesor[idProfesor], 
                        'nombre' => $profesor[nombre],
                        );
        }
        
        return $array;
    }
    
    function getActividadesMeses(){
        $manager = new ManageActividad();
        $lista = $manager->arrayActividadesFecha();
        
        $array = [];
        $cont = 0;
        $mes = array( 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'  );
        
        foreach ($lista as $i => $actividad) {
            $fech = explode("-", $actividad[fecha]);
            $mesnum = $fech[1];
            $nom = $mesnum;
            if( substr($mesnum, -2, 1) == 0){
                $nom = substr($mesnum, -1);
            }

            $encontrado = false;

            foreach ($array as $j => $m) {
                
                if( $array[$j][mes] == $mes[$nom-1] ){
                    $encontrado = true;
                } 
            }
            
            if($encontrado == false){
                $array[$cont] = array(
                    'num' => $mesnum,
                    'mes' => $mes[$nom-1]
                );
                $cont++;
            }
            
        }

        return $array;

    }
    
    function getActividadesSidebar($campo, $valor){

        $manager = new ManageActividad();
        $actividades = $manager->actividadesPor( $pagina = 1, $parametros = array($campo => $valor) );
        
        $array = [];
        
        foreach ($actividades as $i => $actividad) {
            
            $grupo = $this->getGrupo( $actividad[grupo] );
            $profesor = $this->getProfesor( $actividad[profesor] );
            $departamento = $this->getDepartamento( $actividad[departamento] );
            
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
    
    function getActividadesSidebarMes($mes){
        $manager = new ManageActividad();
        $actividades = $manager->actividadesPor();
        
        $array = [];
        $cont = 0;
        
        foreach ($actividades as $i => $actividad) {
            $fech = explode("-", $actividad[fecha]);
            $mesnum = $fech[1];
            
            if($mes ==  $mesnum){
            
                $grupo = $this->getGrupo( $actividad[grupo] );
                $profesor = $this->getProfesor( $actividad[profesor] );
                $departamento = $this->getDepartamento( $actividad[departamento] );
                
                $curso = $grupo->getNombre() . ' ' . $grupo->getNivel();
                
                $array[$cont] = array( 'idActividad' => $actividad[idActividad], 
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
                $cont++;
            }
        }
        return $array;
    }
    
    function getActividadesEntreFechas($fechaA, $fechaB){
        $manager = new ManageActividad();
        $lista = $manager->actividadesPor();
        
        $array = [];
        $cont = 0;

        foreach($lista as $i => $actividad){

            if( ( $fechaA <= $actividad[fecha] ) && ( $fechaB >= $actividad[fecha] ) ){

                $grupo = self::getGrupo( $actividad[grupo] );
                $profesor = self::getProfesor( $actividad[profesor] );
                $departamento = self::getDepartamento( $actividad[departamento] );
        
                $curso = $grupo->getNombre() . ' ' . $grupo->getNivel();
                
                $array[$cont] = array( 'idActividad' => $actividad[idActividad], 
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
                $cont++;
            }
            
        }
        return $array;
    }
    
    function getBusquedaActividad($texto){
        $manager = new ManageActividad();
        $lista = $manager->busqueda($pagina = 1, $condicion = 'titulo', $busqueda = $texto);
        
        $array = [];
        
        foreach ($lista as $i => $actividad) {
            
            $grupo = $this->getGrupo( $actividad[grupo] );
            $profesor = $this->getProfesor( $actividad[profesor] );
            $departamento = $this->getDepartamento( $actividad[departamento] );
            
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
    
    function getBusquedaProfesor($texto){
        $manager = new ManageProfesor();
        $lista = $manager->busqueda($pagina = 1, $condicion = 'nombre', $busqueda = $texto);
        
        $array = [];
        
        foreach ($lista as $i => $profesor) {
            
            $departamento = $this->getDepartamento( $profesor[departamento] );
            
            $array[$i] = array( 'idProfesor' => $profesor[idProfesor], 
                        'nombre' => $profesor[nombre],
                        'departamento' => $departamento->getDepartamento(),
                        'imagen' => $profesor[imagen]
                        );
        }
        
        return $array;
    }
    
    function getBusquedaDepartamento($texto){
        $manager = new ManageDepartamento();
        $lista = $manager->busqueda($pagina = 1, $condicion = 'departamento', $busqueda = $texto);
        
        $array = [];
        
        foreach ($lista as $i => $departamento) {

            $array[$i] = array( 'idDepartamento' => $departamento[idDepartamento], 
                        'departamento' => $departamento[departamento],
                        );
        }
        
        return $array;
    }
    
    function getBusquedaGrupo($texto){
        $manager = new ManageGrupo();
        $lista = $manager->busqueda($pagina = 1, $condicion = 'nombre', $busqueda = $texto);
        
        $array = [];
        
        foreach ($lista as $i => $grupo) {

            $array[$i] = array( 'idGrupo' => $grupo[idGrupo], 
                        'nombre' => $grupo[nombre],
                        'nivel' => $grupo[nivel],
                        );
        }
        
        return $array;
    }
    
    function getDataProfesor($idProfesor){
        $manager = new ManageProfesor();
        $profesor = $manager->get( $idProfesor );
        $departamento = $this->getDepartamento( $profesor->getDepartamento() );
        
        return array( 'idProfesor' => $profesor->getIdProfesor(), 
                        'nombre' => $profesor->getNombre(),
                        'departamento' => $departamento->getDepartamento(),
                        'directivo' => $profesor->getDirectivo(),
                        'imagen' => $profesor->getImagen()
                        );
    }
    
    
}