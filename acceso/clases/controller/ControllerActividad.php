<?php

class ControllerActividad extends Controller {
    
    function userpage(){
        $pagina = Request::read('pagina');
        $this->getActividades($pagina);
    }
    
    function departamentopage(){
        $pagina = Request::read('pagina');
        $this->listDepartamentosPage($pagina);
    }
    
    function grupopage(){
        $pagina = Request::read('pagina');
        $this->listGrupos($pagina);
    }
    
    function getActividades($pagina){
        $readId = Request::read('id');
        
        $total = $this->getModel()->countUser();
        $controllerpage = new PageController($total, $pagina, $rpp=6);
        
        $actividades = $this->getModel()->getActividadesProfesor($readId, $controllerpage->getPage());
        $this->getModel()->setData('actividades', $actividades);
        $this->getModel()->setData('page', $controllerpage->getPage());
        $this->getModel()->setData('pages', $controllerpage->getPages());
    }
    
    function getGrupo(){
        $readId = Request::read('id');
        $grupo = $this->getModel()->getGroup($readId);
        $this->getModel()->setData('grupo', $grupo);
    }
    
    function listGrupos($pagina){
        $total = $this->getModel()->countGrupos();
        $controllerpage = new PageController($total, $pagina, $rpp=10);
        $grupos = $this->getModel()->arrayGrupos($controllerpage->getPage());
        $this->getModel()->setData('grupos', $grupos);
        $this->getModel()->setData('page', $controllerpage->getPage());
        $this->getModel()->setData('pages', $controllerpage->getPages());
    }
    
    function getDepartamento(){
        $readId = Request::read('id');
        $departamento = $this->getModel()->getDepartament($readId);
        $this->getModel()->setData('departamento', $departamento);
    }
    
    function listDepartamentos(){
        $departamentos = $this->getModel()->arrayDepartamentosSinLimit();
        $this->getModel()->setData('departamentos', $departamentos);
    }
    
    function listDepartamentosPage($pagina){
        $total = $this->getModel()->countDepartamentos();
        $controllerpage = new PageController($total, $pagina, $rpp=10);
        $departamentos = $this->getModel()->arrayDepartamento($controllerpage->getPage());
        $this->getModel()->setData('departamentos', $departamentos);
        $this->getModel()->setData('page', $controllerpage->getPage());
        $this->getModel()->setData('pages', $controllerpage->getPages());
    }
    
    function listGruposDepartamentos(){
        $readId = Request::read('idProfesor');
        $departamentos = $this->getModel()->arrayDepartamento();
        $grupos = $this->getModel()->arrayGrupos();
        $this->getModel()->setData('id', $readId);
        $this->getModel()->setData('departamentos', $departamentos);
        $this->getModel()->setData('grupos', $grupos);
    }
    
    function viewact(){
        $idActividad = Request::read('id');
        $actividades = $this->getModel()->getActivity($idActividad);
        $this->getModel()->setData('actividad', $actividades);
    }
    
    function doinsert(){
        $readId = Request::read('idProfesor');
        $readDepartamento = Request::read('departamento');
        $readGrupo = Request::read('grupo');
        $readTitulo = Request::read('titulo');
        $readDescripcion = Request::read('descripcion');
        $readFecha = Request::read('fecha');
        $readLugar = Request::read('lugar');
        $readHoraInicial = Request::read('horaInicio');
        $readHoraFinal = Request::read('horaFinal');
        $readImagen = Request::read('imagen');
        
        $actividad = new actividad();
        $actividad->setDepartamento($readDepartamento);
        $actividad->setGrupo($readGrupo);
        $actividad->setProfesor($readId);
        $actividad->setTitulo($readTitulo);
        $actividad->setDescripcion($readDescripcion);
        $actividad->setFecha($readFecha);
        $actividad->setLugar($readLugar);
        $actividad->setHoraInicio($readHoraInicial);
        $actividad->setHoraFinal($readHoraFinal);
        $actividad->setImagen($readImagen);

        if( $actividad->isValid() ) {
            $a = $this->getModel()->insertActividad($actividad);
        }
        
    }
    
    function doinsertDepartamento(){
        $readDepartamento = Request::read('departamento');
        
        $departamento = new departamento();
        $departamento->setDepartamento($readDepartamento);
        
        $d = $this->getModel()->insertDepartamento($departamento);
        
        if( $d == false){
            $this->getModel()->setData('d', 0);
        }else{
            $this->getModel()->setData('d', 1);
        }

    }
    
    function doinsertGrupo(){
        $readNombre = Request::read('nombre');
        $readNivel = Request::read('nivel');
        
        $grupo = new grupo();
        $grupo->setNombre($readNombre);
        $grupo->setNivel($readNivel);
        
        $g = $this->getModel()->insertGrupo($grupo);
        
        if( $g == false){
            $this->getModel()->setData('g', 0);
        }else{
            $this->getModel()->setData('g', 1);
        }

    }
    
    function dodelete(){
        $readId = Request::read('idActividad');
        $this->getModel()->deleteActividad($readId);
    }
    
    function dodeleteDepartamento(){
        $readId = Request::read('idDepartamento');
        $this->getModel()->deleteDepartamento($readId);
    }
    
    function dodeleteGrupo(){
        $readId = Request::read('idGrupo');
        $this->getModel()->deleteGrupo($readId);
    }
    
    function doeditGrupo(){
        $readId = Request::read('id');
        $readNombre = Request::read('nombre');
        $readNivel = Request::read('nivel');
        
        $grupo = new grupo();
        $grupo->setIdGrupo($readId);
        $grupo->setNombre($readNombre);
        $grupo->setNivel($readNivel);
        
        $g =  $this->getModel()->editGrupo($grupo);
        
        if( $g == false){
            $this->getModel()->setData('g', 0);
        }else{
            $this->getModel()->setData('g', 1);
        }
    }
    
    function doeditDepartamento(){
        $readId = Request::read('id');
        $readDepartamento = Request::read('departamento');
        
        $departamento = new departamento();
        $departamento->setIdDepartamento($readId);
        $departamento->setDepartamento($readDepartamento);
        
        $d = $this->getModel()->editDepartamento($departamento);
        
        if( $d == false){
            $this->getModel()->setData('d', 0);
        }else{
            $this->getModel()->setData('d', 1);
        }
    }
    
    function doedit(){
        $readId = Request::read('id');
        $readDepartamento = Request::read('departamento');
        $readGrupo = Request::read('grupo');
        $readTitulo = Request::read('titulo');
        $readDescripcion = Request::read('descripcion');
        $readFecha = Request::read('fecha');
        $readLugar = Request::read('lugar');
        $readHoraInicio = Request::read('horaInicio');
        $readHoraFinal = Request::read('horaFinal');
        $readImagen = Request::read('imagen');
        
        $actividad = new actividad();
        $actividad->setIdActividad($readId);
        $actividad->setDepartamento($readDepartamento);
        $actividad->setGrupo($readGrupo);
        $actividad->setTitulo($readTitulo);
        $actividad->setDescripcion($readDescripcion);
        $actividad->setFecha($readFecha);
        $actividad->setLugar($readLugar);
        $actividad->setHoraInicio($readHoraInicio);
        $actividad->setHoraFinal($readHoraFinal);
        $actividad->setImagen($readImagen);
        
        return $this->getModel()->editActividad($actividad);
        
    }
    
    function getActividadGrupoDepartamento(){
        $readId = Request::read('id');
        $actividad = $this->getModel()->getActivity($readId);
        $this->getModel()->setData('actividad', $actividad);
        $departamentos = $this->getModel()->arrayDepartamento();
        $this->getModel()->setData('departamentos', $departamentos);
        $grupos = $this->getModel()->arrayGrupos();
        $this->getModel()->setData('grupos', $grupos);
    }
    
}